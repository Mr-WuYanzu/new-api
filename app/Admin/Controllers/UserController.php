<?php

namespace App\Admin\Controllers;

use App\Firm;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Firm);
        $grid->model()->where('status','=','2');
        $grid->id('Id');
        $grid->firm_name('Firm name');
        $grid->legal_person('Legal person');
        $grid->tax_no('Tax no');
        $grid->permit('Permit');
        $grid->appid('Appid');
        $grid->pub_banknum('Pub banknum');
        $grid->key('Key');
        $grid->status('Status');
        $grid->reg_num('Reg num');

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
        $show = new Show(Firm::findOrFail($id));

        $show->id('Id');
        $show->firm_name('Firm name');
        $show->legal_person('Legal person');
        $show->tax_no('Tax no');
        $show->permit('Permit');
        $show->appid('Appid');
        $show->pub_banknum('Pub banknum');
        $show->key('Key');
        $show->status('Status');
        $show->reg_num('Reg num');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Firm);

        $form->text('firm_name', 'Firm name');
        $form->text('legal_person', 'Legal person');
        $form->text('tax_no', 'Tax no');
        $form->text('permit', 'Permit');
        $form->text('appid', 'Appid');
        $form->text('pub_banknum', 'Pub banknum');
        $form->text('key', 'Key');
        $form->switch('status', 'Status')->default(1);
        $form->number('reg_num', 'Reg num');

        return $form;
    }
}
