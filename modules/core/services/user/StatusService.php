<?php
namespace app\modules\core\services\user;

use app\modules\core\models\base\User;

class StatusService
{
    /**
     * Возвращает массив статусов баннов
     * @return array
     */
    public static function statusBanned(): array
    {
        return [
            User::STATUS_BAN_ID,
        ];
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function checkStatusBanUser(User $user): bool
    {
        return in_array($user->status_id, self::statusBanned());
    }
}