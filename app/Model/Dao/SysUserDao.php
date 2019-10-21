<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Model\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Log\Log;
use App\Model\SysMenu;
use App\Model\SysRoleMenu;
use App\Model\SysUser;
use App\Model\SysUserRole;
use App\Service\Formatter\SysMenuFormatter;
use App\Service\Formatter\SysRoleMenuFormatter;
use App\Service\Service;
use Hyperf\DbConnection\Db;

class SysUserDao extends Service
{
    /**
     * @param $user_id
     * @param bool $throw
     * @return null|SysUserDao
     */
    public function first($user_id, $throw = true)
    {
        $model = SysUser::query()->where('user_id', $user_id)->first();
        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::USER_NOT_EXIST);
        }
        return $model;
    }

    /**
     * @param $username
     * @param bool $throw
     * @return mixed
     */
    public function getOne($username, $throw = true)
    {
        $model = SysUser::query()->where('username', $username)->first();
        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::USER_NOT_EXIST);
        }
        return $model;
    }

    /**
     * 获取管理用户的role_id
     * @param $user_id
     * @param bool $throw
     * @return mixed
     */
    public function getUserRole($user_id, $throw = true)
    {

        $model = SysUserRole::query()->where('user_id', $user_id)->first();
        if (empty($model) && $throw) {
            throw new BusinessException(ErrorCode::NOTE_NOT_EXIST);
        }
        return $model;
    }


    public function getTotalCount(int $user_id = 1):int
    {
        if ($user_id == 1) {
            $count = Db::table('sys_user')->count();
        } else {
            $count = Db::table('sys_user')->where("create_user_id",$user_id)->count();
        }
        return $count;
    }
}
