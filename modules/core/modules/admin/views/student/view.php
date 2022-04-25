<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Bases'), 'url' => ['/admin/bases']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <?php
        if ($model->activity_id === Student::ACTIVITY_ENABLE_ID) {
            echo Html::a(
                IcoComponent::disable() . ' ' . Module::t('app', 'To archive'),
                ['disable', 'id' => $model->id],
                [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Module::t('note', 'Are you sure you want to archive the student?'),
                    ],
                ]
            );
        } elseif ($model->activity_id === Student::ACTIVITY_DISABLE_ID) {
            echo Html::a(
                IcoComponent::enable() . ' ' . Module::t('app', 'Activate'),
                ['enable', 'id' => $model->id],
                [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Module::t('note', 'Are you sure you want to activate the student?'),
                    ],
                ]
            );
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'patronymic',
            'genderTitle',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $user = $model->user;
                    $btn = '';
                    if($user){
                        $btn = Html::a($model->user->getFullname(),
                                   Url::to(['/user/view', 'id' => $model->user_id]),
                                   ['class' => 'btn btn-primary']);
                    }
                    return $btn;
                }
            ],
            [
                'attribute' => 'department_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->department->short_title,
                                   Url::to(['/department/view', 'id' => $model->department_id]),
                                   ['class' => 'btn btn-primary']);
                }
            ],
            [
                'attribute' => 'activity_id',
                'value' => function ($model) {
                    return $model->activity;
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return date('j F, Y H:i:s', $model->updated_at);
                }
            ]
        ],
    ]) ?>

</div>
