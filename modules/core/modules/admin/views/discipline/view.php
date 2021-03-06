<?php

use app\modules\core\Module;
use app\modules\core\modules\admin\components\ActivityComponent;
use app\modules\core\modules\admin\components\IcoComponent;
use app\modules\core\modules\admin\models\Discipline;
use app\modules\core\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\base\Discipline */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Dictionaries'), 'url' => ['/admin/dictionaries']];
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Disciplines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="discipline-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->identity->role !== User::ROLE_MODERATOR) { ?>
            <?= Html::a(IcoComponent::edit() . ' ' . Module::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(IcoComponent::delete() . ' ' . Module::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php
        if ($model->activity_id === Discipline::ACTIVITY_ENABLE_ID) {
            echo Html::a(IcoComponent::disable() . ' ' . Module::t('app', 'To archive'), ['disable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to archive the discipline?'),
                ],
            ]);
        } elseif ($model->activity_id === Discipline::ACTIVITY_DISABLE_ID) {
            echo Html::a(IcoComponent::enable() . ' ' .Module::t('app', 'Activate'), ['enable', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Module::t('note', 'Are you sure you want to activate the discipline?'),
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'short_title',
            [
                'attribute' => 'activity_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ActivityComponent::getLabel($model->activity_id);
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, "php:d.m.Y H:i:s");
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, "php:d.m.Y H:i:s");
                }
            ]
        ],
    ]) ?>

</div>
