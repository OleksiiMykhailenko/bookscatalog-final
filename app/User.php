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
        return $this->belongsToMany('App\Models\Role', 'users_roles', 'user_id', 'role_id');
    }
    /**
     * Проверка принадлежит ли пользователь к какой либо роли
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }
    /**
     * Проверка имеет ли пользователь определенную роль
     *
     * @return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'name'));
        // начиная с версии 5.1 метода array_fetch не существует
        //return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }
    /**
     * Получение идентификатора роли
     *
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key + 1;
            }
        }
        return false;
    }
    /**
     * Добавление роли пользователю
     *
     * @return boolean
     */
    public function makeEmployee($title)
    {
        $assigned_roles = array();
        $roles = array_fetch(Role::all()->toArray(), 'name');
        switch ($title) {
            case 'super_admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'super_admin');
            case 'admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'admin');
            case 'teacher':
                $assigned_roles[] = $this->getIdInArray($roles, 'teacher');
            case 'student':
                $assigned_roles[] = $this->getIdInArray($roles, 'student');
            case 'login':
                $assigned_roles[] = $this->getIdInArray($roles, 'login');
                break;
            default:
                $assigned_roles[] = false;
        }
        $this->roles()->attach($assigned_roles);
    }
    /****/
}