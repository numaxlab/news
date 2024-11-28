<?php

namespace NumaxLab\NewsPost\Http\Controllers\Admin;


use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
        CRUD::setModel((config('news-post.new_post_model_namespace')));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/new-post-crud-controller');
        CRUD::setEntityNameStrings(__('news_post::backpack_messages.new'), __('news_post::backpack_messages.news'));
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
            'label' => __('news_post::backpack_messages.label.title'),
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'published_at',
            'label' => __('news_post::backpack_messages.label.published_at'),
            'type' => 'datetime',
            'format' => 'DD/MM/YYYY HH:mm:ss',
        ]);
        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('news_post::backpack_messages.label.is_public'),
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
            'label' => __('news_post::backpack_messages.label.title'),
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
            'label' => __('news_post::backpack_messages.label.introduction'),
            'type' => 'textarea',
            'attributes' => [
                'rows' => 5,
            ]
        ]);

        CRUD::addField([
            'name' => 'content',
            'label' => __('news_post::backpack_messages.label.content'),
            'type' => 'ckeditor',
            'elfinderOptions' => true,
        ]);

        CRUD::addField([
            'name' => 'image_file_path',
            'label' => __('news_post::backpack_messages.label.image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => __('news_post::backpack_messages.folders.news_posts'),
            ],
            'hint' => __('news_post::backpack_messages.hints.minimum_recommended_dimensions') . ': 1392x779px'

        ]);

        CRUD::addField([
            'name' => 'caption',
            'label' => __('news_post::backpack_messages.label.caption'),
            'type' => 'text'
        ]);

        CRUD::addfield([
            'name' => 'published_at',
            'label' => __('news_post::backpack_messages.label.published_at'),
            'type' => 'datetime_picker',
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => __('news_post::backpack_messages.label.is_public'),
            'type' => 'checkbox',
            'wrapper' => ['class' => 'form-group col-md-6 mt-md-5']
        ]);
    }
}
