<?php

namespace app\modules\core\models\base;

use app\modules\core\Module;
use yii\behaviors\TimestampBehavior;
use app\modules\core\services\log\LogStatus;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "core_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property string|null $message
 * @property int $status_id
 * @property string|null $description
 * @property int|null $created_at
 *
 * @property Department $department
 * @property User $user
 * @property string $status
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%core_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'department_id', 'status_id', 'message'], 'required'],
            [['user_id', 'department_id', 'status_id'], 'default', 'value' => null],
            [['user_id', 'department_id', 'status_id'], 'integer'],
            [['message', 'description'], 'string'],
            [['created_at'], 'safe'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'Id'),
            'user_id' => Module::t('app', 'User'),
            'department_id' => Module::t('app', 'Department'),
            'message' => Module::t('app', 'Message'),
            'status_id' => Module::t('app', 'Status'),
            'description' => Module::t('app', 'Description'),
            'created_at' => Module::t('app', 'Created at'),
        ];
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [],
                ],
            ],
        ];
    }

    /**
     * Возвращает массив статусов
     * @return array
     */
    public static function getStatusesIds(): array
    {
        return [
            LogStatus::STATUS_INFO,
            LogStatus::STATUS_SUCCESS,
            LogStatus::STATUS_WARNING,
            LogStatus::STATUS_DANGER,
            LogStatus::STATUS_CRAZY,
        ];
    }

    /**
     * Возвращает мап статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            LogStatus::STATUS_INFO => Module::t('app', 'info'),
            LogStatus::STATUS_SUCCESS => Module::t('app','success'),
            LogStatus::STATUS_WARNING => Module::t('app','warning'),
            LogStatus::STATUS_DANGER => Module::t('app','danger'),
            LogStatus::STATUS_CRAZY => Module::t('app','crazy'),
        ];
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return self::getStatuses()[$this->status_id];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
