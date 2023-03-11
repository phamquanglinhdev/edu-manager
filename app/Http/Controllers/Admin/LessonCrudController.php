<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LessonRequest;
use App\Models\Grade;
use App\Models\Student;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LessonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LessonCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Lesson::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lesson');
        CRUD::setEntityNameStrings('Buổi học', 'Những buổi học');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('grade_id')->label("Lớp học");
        CRUD::column('name')->label("Tên buổi học");
        CRUD::column('day')->label("Ngày học");
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
        CRUD::setValidation(LessonRequest::class);

        if (isset($_REQUEST["grade_id"])) {
            $grade = Grade::where("id", $_REQUEST["grade_id"])->first();
            if (isset($grade->name)) {
                CRUD::field('grade_id')->type("hidden")->value($grade->id);
                CRUD::field('name')->label("Tên buổi học")->default("Buổi học của lớp " . $grade->name);
                CRUD::field('day')->label("Ngày học");
                CRUD::field('start')->label("Bắt đầu");
                CRUD::field('end')->label("Kết thúc");
                CRUD::addField(
                    [   // select_and_order
                        'name' => 'students',
                        'label' => 'Học sinh tham gia',
                        'type' => 'select_and_order',
                        'options' => Student::whereHas("grades", function (Builder $builder) use ($grade) {
                            $builder->where("id", $grade->id);
                        })->get()->pluck('name', 'id')->toArray(),
                    ],
                );
            } else {
                CRUD::field('grade_id')->type("select2")->label("Lớp học")->wrapper([
                    'id' => 'pre-load',
                    'name' => 'grade_id',
                ]);
            }
        } else {
            CRUD::field('grade_id')->type("select2")->label("Lớp học")->wrapper([
                'id' => 'pre-load',
                'name' => 'grade_id',
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
        $_REQUEST["grade_id"] = $this->crud->getCurrentEntry()->grade->id;
        $this->setupCreateOperation();
    }
}
