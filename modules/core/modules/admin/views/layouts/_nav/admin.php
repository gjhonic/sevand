<?php

use app\modules\core\models\base\User;
use app\modules\core\Module;
use yii\helpers\Url;

if (Yii::$app->user->identity->role === User::ROLE_ROOT) {
    return [
        [
            'label' => Module::t('app', 'Bases'),
            'url' => Url::to('/admin/bases')
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => ['/']
        ]
    ];
} else if (Yii::$app->user->identity->role === User::ROLE_ADMIN) {
    return [
        [
            'label' => Module::t('app', 'Admin panel'),
            'url' => Url::to('/admin'),
            'ico' => '',
        ],
        [
            'label' => Module::t('app', 'Settings'),
            'url' => ['/'],
            'ico' => '',
        ]
    ];
} else {
    return [
        [
            'label' => Module::t('app', 'Settings'),
            'url' => ['/'],
            'ico' => '',
        ]
    ];
}
