<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplementRequest;
use App\Models\Student;
use App\Models\Sup;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SupplementCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupplementCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Supplement::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/supplement');
        CRUD::setEntityNameStrings('Buổi học bổ trợ', 'Những buổi học bổ trợ');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('sup_id')->label("Lớp bổ trợ");
        CRUD::column('name')->label("Tên buổi học bổ trợ");
        CRUD::column('day')->label("Ngày");
        CRUD::column('start')->label("Bắt đầu");
        CRUD::column('end')->label("Kết thúc");


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
        CRUD::setValidation(SupplementRequest::class);

        if (isset($_REQUEST["sup_id"])) {
            $sup = Sup::where("id", $_REQUEST["sup_id"])->first();
            if (isset($sup->name)) {
                CRUD::field('sup_id')->type("hidden")->value($sup->id);
                CRUD::field('name')->label("Tên buổi học bổ trợ")->value("Buổi học của \"$sup->name\"");
                CRUD::field('day')->label("Ngày");
                CRUD::field('start')->label("Bắt đầu");
                CRUD::field('end')->label("Kết thúc");
                CRUD::addField(
                    [   // select_and_order
                        'name' => 'students',
                        'label' => 'Học sinh tham gia',
                        'type' => 'select_and_order',
                        'options' => Student::whereHas("sups", function (Builder $builder) use ($sup) {
                            $builder->where("id", $sup->id);
                        })->get()->pluck('name', 'id')->toArray(),
                    ],
                );
            } else {
                CRUD::field('sup_id')->label("Lớp bổ trợ")->type("select2")->wrapper([
                    'id' => 'pre-load',
                    'name' => 'sup_id'
                ]);
            }
        } else {
            CRUD::field('sup_id')->label("Lớp bổ trợ")->type("select2")->wrapper([
                'id' => 'pre-load',
                'name' => 'sup_id'
            ]);
        }

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
        Widget::add()->type('script')->content('/js/pre-load.js');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $_REQUEST["sup_id"] = $this->crud->getCurrentEntry()->sup->id;
        $this->setupCreateOperation();
    }
}
