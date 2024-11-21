<?php

namespace NumaxLab\NewsPost\Http\Controllers\Admin;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use NumaxLab\NewsPost\Models\NewsPost;

/**
 * Class NewsPostCrudControllerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsPostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(NewsPost::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/new-post-crud-controller');
        CRUD::setEntityNameStrings('new', 'news');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Título',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'published_at',
            'label' => 'Fecha de publicación',
            'type' => 'datetime',
            'format' => 'DD/MM/YYYY HH:mm:ss',
        ]);
        CRUD::addColumn([
            'name' => 'is_public',
            'label' => 'Pública',
            'type' => 'check',
        ]);
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

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'title' => 'required',
            'introduction' => 'required',
            'published_at' => 'required',
            'content' => 'required',
            'image_file_path' => 'required'
        ]);


        CRUD::addField([
            'name' => 'title',
            'label' => 'Título',
            'type' => 'text'
        ]);

        CRUD::addField([   // Text
            'name' => 'slug',
            'target' => 'title',
            'label' => "Slug",
            'type' => 'slug',
        ]);


        CRUD::addField([
            'name' => 'introduction',
            'label' => 'Introducción',
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'content',
            'label' => 'Contenido',
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'image_file_path',
            'label' => 'Imagen',
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => 'posts',
            ],
            'hint' => 'Dimensiones mínimas recomendadas: 1392x779px'

        ]);

        CRUD::addField([
            'name' => 'caption',
            'label' => 'Pie de foto',
            'type' => 'text'
        ]);

        CRUD::addfield([
            'name' => 'published_at',
            'label' => 'Fecha de publicación',
            'type' => 'datetime_picker',
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => 'Pública',
            'type' => 'checkbox',
            'wrapper' => ['class' => 'form-group col-md-6 mt-md-5']
        ]);
    }
}
