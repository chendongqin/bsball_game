<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/17
 * Time: 14:42
 */

namespace App\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Base extends Model
{
    protected $guarded = [];
    public $dateFormat = 'U';
    public $timestamps = true;

}