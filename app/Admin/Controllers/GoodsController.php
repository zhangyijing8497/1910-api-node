<?php

namespace App\Admin\Controllers;

use App\Model\Index\GoodsModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '商品';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodsModel());

        $grid->column('goods_id', __('商品 id'));
        $grid->column('goods_sn', __('商品编号'));
        $grid->column('goods_name', __('商品名称'));
        $grid->column('keywords', __('关键字'));
        $grid->column('goods_number', __('库存'));
        $grid->column('shop_price', __('商品单价'));
        $grid->column('goods_img', __('商品图片'))->image();
        $grid->column('goods_desc', __('商品详情'));
        $grid->column('sale_num', __('销售量'));
        $grid->column('is_new', __('是否新品'));
        $grid->column('is_hot', __('是否热卖'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(GoodsModel::findOrFail($id));

        $show->field('goods_id', __('商品id'));
        $show->field('goods_sn', __('商品编号'));
        $show->field('goods_name', __('商品名称'));
        $show->field('keywords', __('关键字'));
        $show->field('goods_number', __('库存'));
        $show->field('shop_price', __('商品单价'));
        $show->field('goods_img', __('商品图片'));
        $show->field('goods_desc', __('商品详情'));
        $show->field('sale_num', __('销售量'));
        $show->field('is_new', __('是否新品'));
        $show->field('is_hot', __('是否热卖'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodsModel());

        $form->text('goods_sn', __('商品编号'));
        $form->text('goods_name', __('商品名称'));
        $form->text('keywords', __('关键字'));
        $form->number('goods_number', __('商品库存'));
        $form->decimal('shop_price', __('商品单价'))->default(0.00);
        $form->file('goods_img', __('商品图片'));
        $form->text('goods_desc', __('商品详情'));
        $form->switch('is_new', __('Is new'))->default(1);
        $form->switch('is_hot', __('Is hot'));

        return $form;
    }
}
