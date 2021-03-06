<?php
/**
 * StudentController
 * Контроллер для работы со студентами
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\controllers;

use app\modules\core\modules\admin\models\Student;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\search\StudentSearch;
use app\modules\core\Module;
use app\modules\core\services\log\LogMessage;
use app\modules\core\services\log\LogService;
use app\modules\core\services\log\LogStatus;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    $this->redirect(Url::to(['/signin']));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'enable', 'disable', 'transfer'],
                        'roles' => [User::ROLE_ROOT, User::ROLE_ADMIN, User::ROLE_MODERATOR],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => [User::ROLE_ROOT, User::ROLE_ADMIN],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            if (StatusService::checkStatusBanUser(Yii::$app->user->identity)) {
                $this->redirect('/ban');
            }
        }

        return parent::beforeAction($action);
    }

    public $layout = 'admin';

    /**
     * Lists all Student models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Метод переводит студента.
     * @return string|\yii\web\Response
     */
    public function actionTransfer($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->transferStudent()) {
                LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_STUDENT_TRANSFERRED, 'StudentId: ' . $model->id);
                Yii::$app->session->setFlash('success', Module::t('note', 'Student successfully transferred'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_STUDENT_TRANSFER);
                Yii::$app->session->setFlash('danger', Module::t('error', 'Student not transferred'));
            }
        }

        return $this->render('transfer_student', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Student
    {
        if (($model = Student::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('error', 'The requested page does not exist.'));
    }

    /**
     * Enable student
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEnable($id)
    {
        $student = $this->findModel($id);
        if ($student->enable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_STUDENT_ENABLED, 'StudentId: ' . $student->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Student successfully enabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_STUDENT_ENABLED, 'StudentId: ' . $student->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Student not enabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Disable student
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDisable($id)
    {
        $student = $this->findModel($id);
        if ($student->disable()) {
            LogService::createLog(LogStatus::STATUS_SUCCESS, Yii::$app->user->identity->id, LogMessage::SUCCESS_STUDENT_DISABLED, 'StudentId: ' . $student->id);
            Yii::$app->session->setFlash('success', Module::t('note', 'Student successfully disabled'));
        } else {
            LogService::createLog(LogStatus::STATUS_DANGER, Yii::$app->user->identity->id, LogMessage::DANGER_STUDENT_DISABLED, 'StudentId: ' . $student->id);
            Yii::$app->session->setFlash('danger', Module::t('error', 'Student not disabled'));
        }

        return $this->redirect(['view', 'id' => $id]);
    }
}
