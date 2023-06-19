<?php

namespace App\Admin\Controllers;

use App\Models\Recipes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RecipesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recipes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Recipes());

        $grid->column('id', __('Id'));
        $grid->column('userid', __('Userid'));
        $grid->column('title', __('Title'));
        $grid->column('desc', __('Desc'));
        $grid->column('preptime', __('Preptime'));
        $grid->column('cooktime', __('Cooktime'));
        $grid->column('servings', __('Servings'));
        $grid->column('instructions', __('Instructions'));
        $grid->column('ispublic', __('Ispublic'));
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
        $show = new Show(Recipes::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('userid', __('Userid'));
        $show->field('title', __('Title'));
        $show->field('desc', __('Desc'));
        $show->field('preptime', __('Preptime'));
        $show->field('cooktime', __('Cooktime'));
        $show->field('servings', __('Servings'));
        $show->field('instructions', __('Instructions'));
        $show->field('ispublic', __('Ispublic'));
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
        $form = new Form(new Recipes());

        $form->number('userid', __('Userid'));
        $form->text('title', __('Title'));
        $form->textarea('desc', __('Desc'));
        $form->number('preptime', __('Preptime'));
        $form->number('cooktime', __('Cooktime'));
        $form->number('servings', __('Servings'));
        $form->textarea('instructions', __('Instructions'));
        $form->switch('ispublic', __('Ispublic'));

        return $form;
    }
}
