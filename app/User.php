<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /****/
    /**
     * Функция для получение название роли к которой пользователь принадлежит.
     *
     * @return boolean
     **/

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Проверка имеет ли пользователь определенную роль
     *
     * @return boolean
     */
    public function hasRole($check)
    {
        return $this->roles->contains('name', $check);
    }
}