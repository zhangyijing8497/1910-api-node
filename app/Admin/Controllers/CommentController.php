<?php

namespace App\Admin\Controllers;

use App\Model\Index\CommentModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CommentModel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CommentModel());

        $grid->column('comment_id', __('Comment id'));
        $grid->column('goods_id', __('Goods id'));
        $grid->column('comment_name', __('Comment name'));
        $grid->column('email', __('Email'));
        $grid->column('subject', __('Subject'));
        $grid->column('comment_desc', __('Comment desc'));
        $grid->column('add_time', __('Add time'));

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
        $show = new Show(CommentModel::findOrFail($id));

        $show->field('comment_id', __('Comment id'));
        $show->field('goods_id', __('Goods id'));
        $show->field('comment_name', __('Comment name'));
        $show->field('email', __('Email'));
        $show->field('subject', __('Subject'));
        $show->field('comment_desc', __('Comment desc'));
        $show->field('add_time', __('Add time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CommentModel());

        $form->number('goods_id', __('Goods id'));
        $form->text('comment_name', __('Comment name'));
        $form->email('email', __('Email'));
        $form->text('subject', __('Subject'));
        $form->text('comment_desc', __('Comment desc'));
        $form->number('add_time', __('Add time'));

        return $form;
    }
}
