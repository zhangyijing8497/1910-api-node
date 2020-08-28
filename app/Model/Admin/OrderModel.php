<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    public $table = 'order_info';
    public $primaryKey = 'order_id';
    public $timestamps = false;
}
