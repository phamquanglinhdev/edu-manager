<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupRequest;
use App\Models\Grade;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class SupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Sup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sup');
        CRUD::setEntityNameStrings('Lớp bổ trợ', 'Những lớp bổ trợ');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('name')->label("Tên lớp bổ trợ");
        CRUD::column('grade_id')->label("Bổ trợ của lớp");

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SupRequest::class);


        if (isset($_REQUEST['grade_id'])) {
            $grade = Grade::where("id", $_REQUEST["grade_id"])->first();
            if (isset($grade->name)) {
                CRUD::field('grade_id')->type("hidden")->value($grade->id);
                CRUD::field('name')->label("Tên lớp bổ trợ")->default("Bổ trợ của lớp " . $grade->name);
            } else {
                CRUD::field('grade_id')->label("Bổ trợ của lớp")->type("select2")->wrapper([
                    'id' => 'pre-load',
                    'name' => 'grade_id',
                ]);
            }

        } else {
            CRUD::field('grade_id')->label("Bổ trợ của lớp")->type("select2")->wrapper([
                'id' => 'pre-load',
                'name' => 'grade_id',
            ]);
        }
        Widget::add()->type('script')->content('/js/pre-load.js');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
