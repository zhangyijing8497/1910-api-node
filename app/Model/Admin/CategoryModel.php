<?php

namespace App\Model\Admin;

use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use ModelTree;
    public $table = 'p_category';
    public $primaryKey = 'cat_id';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort_order');
        $this->setTitleColumn('cat_name');
    }
}
