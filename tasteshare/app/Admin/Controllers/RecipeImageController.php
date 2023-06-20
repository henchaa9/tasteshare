<?php

namespace App\Admin\Controllers;

use App\Models\RecipeImages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RecipeImageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RecipeImages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RecipeImages());

        $grid->column('id', __('Id'));
        $grid->column('recipeid', __('Recipeid'));
        $grid->column('imageurl', __('Imageurl'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(RecipeImages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('recipeid', __('Recipeid'));
        $show->field('imageurl', __('Imageurl'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RecipeImages());

        $form->number('recipeid', __('Recipeid'));
        $form->text('imageurl', __('Imageurl'));

        return $form;
    }
}
