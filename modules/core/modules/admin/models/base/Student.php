<?php

namespace app\modules\core\modules\admin\models\base;

use app\modules\core\models\base\Student as BaseStudent;
use Yii;


class Student extends BaseStudent
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setDepartmentFromUser();
            } else {
                if($this->department_id !== Yii::$app->user->identity->department_id){
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Устанавливает факультет пользователя
     */
    public function setDepartmentFromUser()
    {
        $this->department_id = Yii::$app->user->identity->department_id;
    }
}
