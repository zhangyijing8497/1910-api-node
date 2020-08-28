<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class CommodityModel extends Model
{
    public $table = 'p_goods';
    public $primaryKey = 'goods_id';
    public $timestamps = false;
}
