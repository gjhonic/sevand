<?php
/**
 * CourseController
 * Контроллер для работы с курсами в модуле core/admin
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */

namespace app\modules\core\modules\admin\controllers;

use app\modules\core\modules\admin\models\Course;
use app\modules\core\modules\admin\models\search\CourseSearch;
use app\modules\core\modules\admin\models\search\GroupSearch;
use app\modules\core\modules\admin\models\User;
use app\modules\core\Module;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DepartmentController for Department model.
 */
class CourseController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function () {
                    $this->redirect(Url::to(['/signin']));
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view', 'index'],
                        'roles' => [User::ROLE_MODERATOR, User::ROLE_ADMIN, User::ROLE_ROOT],
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
     * Lists all Course models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Course model.
     * @return string
     * @param int $id
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $course = $this->findModel($id);

        $groupSearchModel = new GroupSearch();
        $groupSearchModel->course_id = $course->id;
        $groupDataProvider = $groupSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $course,
            'groupDataProvider' => $groupDataProvider,
            'groupSearchModel' => $groupSearchModel,
        ]);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Course
    {
        if (($model = Course::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('error', 'The requested page does not exist.'));
    }
}
