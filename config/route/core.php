<?php

//Роутинг на модуль "Core"
return [
    'me' => 'core/page/me',
    'ban' => 'core/page/ban',

    '' => 'core/page/index',
    'index' => 'core/page/index',

    'admin' => 'core/admin/page/index',
    'root' => 'core/root/page/index',
    'personal' => 'core/personal/page/index',
    'api' => 'core/api/page/index',

    'admin/index' => 'core/admin/page/index',
    'admin/bases' => 'core/admin/page/bases',
    'admin/dictionaries' => 'core/admin/page/dictionaries',

    'root/index' => 'core/root/page/index',
    'root/bases' => 'core/root/page/bases',
    'root/dictionaries' => 'core/root/page/dictionaries',

    'personal/index' => 'core/personal/page/index',

    'admin/<controller:\w+>/<action:\w+>' => 'core/admin/<controller>/<action>',

    'root/<controller:\w+>/<action:\w+>' => 'core/root/<controller>/<action>',

    'personal/<controller:\w+>/<action:\w+>' => 'core/personal/<controller>/<action>',

    'api/<controller:\w+>/<action:\w+>' => 'core/api/<controller>/<action>',

    //'admin/<action:\w+>' => 'core/admin/<action>',
    '<controller:\w+>/<action:\w+>' => 'core/<controller>/<action>',
];