<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'users_social';

     /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['line_notify'];

}
