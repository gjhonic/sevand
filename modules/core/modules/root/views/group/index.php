<?php

use app\modules\core\models\base\Course;
use app\modules\core\models\base\Department;
use app\modules\core\models\base\Direction;
use app\modules\core\models\base\Group;
use app\modules\core\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        [
            'attribute' => 'course_id',
            'filter' => Course::getCourseMap(),
            'value' => function ($model) {
                return $model->course->title;
            }
        ],
        [
            'attribute' => 'department_id',
            'filter' => Department::getDepartmentGroup(),
            'value' => function ($model) {
                return $model->department->short_title;
            }
        ],

        [
            'attribute' => 'direction_id',
            'filter' => Direction::getDirectionMap(),
            'value' => function ($model) {
                return $model->direction->short_title;
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ]; ?>

    <?= DynaGrid::widget([
     'gridOptions' => [
     'resizeStorageKey' => 'clients',
     'dataProvider' => $dataProvider,
     //'filterModel' => $searchModel,
     'pjax' => true,
     'toolbar' => [
         ['content' =>
             Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                 'data-pjax' => 0,
                 'class' => 'btn btn-default',
                 'title' => Yii::t('app', 'Reset')]) .
             Html::a('<i class="glyphicon glyphicon-print"></i>', ['#'], [
                 'data-pjax' => 0,
                 'class' => 'btn btn-default print-grid',
                 'title' => Yii::t('app', 'Print')]),
         ],
         ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
         '{toggleData}',
         '{export}',
     ],
     'panel' => [
         'after' => false
     ],
     'exportConversions' => [
         ['from_xls' => '-', 'to_xls' => '–'],
     ],
     'exportConfig' => array_fill_keys([
           GridView::HTML,
           GridView::CSV,
           GridView::TEXT,
           GridView::EXCEL,
           GridView::PDF,
           GridView::JSON
       ], ['filename' => Yii::t('app', 'Clients') . ' ' . date('Y-m-d')]),
     ],
     'options' => [
         'id' => 'clients'
     ],
     'columns' => $columns,
     ]); ?>

</div>
