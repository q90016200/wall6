<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    // protected $table = 'posts';


    /**
     * 重定义主键
     *
     * @var string
     */
    protected $primaryKey = 'post_id';
}
