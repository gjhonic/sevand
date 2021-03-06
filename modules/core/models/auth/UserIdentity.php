<?php


namespace app\modules\core\models\auth;

use app\modules\core\models\base\Department;
use app\modules\core\models\base\User;
use Yii;
use yii\web\IdentityInterface;

/**
 * Class UserIdentity
 * @package app\models\auth
 *
 * FROM USER
 * @property int $role_id
 * @property string $code
 * @property string $username
 *
 * От класса User
 * @property int $id
 * @property int $department_id
 * @property string $role
 * @property string groupRole
 * @property Department $department
 */
class UserIdentity extends User implements IdentityInterface
{

    /**
     * Метод возвращает пользователя по его id
     * @param int|string $id
     * @return UserIdentity|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Метод возвращает пользователя по его access_token
     * @param mixed $token
     * @param null $type
     * @return UserIdentity|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Метод возвращает пользователя по его username
     * @param string $username
     * @return UserIdentity|array|\yii\db\ActiveRecord|null
     */
    public static function findByUsername(string $username): ?User
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Метод возвращает id пользователя
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Метод возвращает авторизационный ключ юзера
     * @return string|null
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Метод возвращает авторизационный ключ юзера
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Метод валидации паролей
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Метод возвращает текущего пользователя в системе
     * @return mixed
     */
    public static function currentUser()
    {
        return parent::findUser(Yii::$app->user->identity->attributes['id']);
    }

    /**
     * Метод возвращает id текущего пользователя в системе
     * @return mixed
     */
    public static function IdCurrentUser()
    {
        return Yii::$app->user->identity->attributes['id'];
    }
}