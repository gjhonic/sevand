<?php
/**
 * PageController
 * Основной Контроллер модуля core/admin
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 *
 */
namespace app\modules\core\modules\admin\controllers;

use app\modules\core\modules\admin\models\Course;
use app\modules\core\modules\admin\models\Discipline;
use app\modules\core\modules\admin\models\Student;
use app\modules\core\modules\admin\models\User;
use app\modules\core\modules\admin\models\Group;
use app\modules\core\modules\admin\models\Direction;
use app\modules\core\services\user\StatusService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `core/admin` module
 */
class PageController extends Controller
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
                        'actions' => ['index', 'bases', 'dictionaries', 'settings'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * HomePage admin
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Показывает страницу баз
     * @return string
     */
    public function actionBases()
    {
        $userCount = User::find()->count();
        $groupCount = Group::find()->count();
        $studentCount = Student::find()->count();

        return $this->render('bases',[
            'userCount' => $userCount,
            'groupCount' => $groupCount,
            'studentCount' => $studentCount,
        ]);
    }

    /**
     * Показывает страницу справочников
     * @return string
     */
    public function actionDictionaries()
    {
        $directionCount = Direction::find()->count();
        $courseCount = Course::find()->count();
        $disciplineCount = Discipline::find()->count();
        return $this->render('dictionaries', [
            'directionCount' => $directionCount,
            'courseCount'    => $courseCount,
            'disciplineCount' => $disciplineCount,

        ]);
    }
}
