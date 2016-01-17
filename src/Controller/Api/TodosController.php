<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;

class TodosController extends AppController
{
    // public $paginate = [
    //     'page' => 1,
    //     'limit' => 5,
    //     'maxLimit' => 15,
    //     'sortWhitelist' => [
    //         'id', 'name'
    //     ]
    // ];

    // public function initialize()
    // {
    //     parent::initialize();
    //     // $this->Auth->allow(['index']);
    //     // $this->Auth->deny();
    // }

    public function beforeFilter(Event $event) {
        // $this->Crud->on('beforePaginate', function(CakeEvent $event) {
        //     $model = $event->subject->model;
        //     $request = $event->subject->request;

        //     $event->subject->paginator->settings += [
        //         'conditions' => [
        //             $model->conditionCenter($request->query)
        //         ]
        //     ];
        // });

        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->Crud->on('beforePaginate', function(\Cake\Event\Event $event) {
            $this->paginate['conditions']['user_id'] = $this->Auth->User('id');
            // $this->paginate['finder'] = [
            //     'ApiIndex' => ['user_id' => 1]
            // ];
        });

        // $this->paginate = [
        //     'contain' => ['Users']
        // ];
        // $this->set('todos', $this->paginate($this->Todos));
        // $this->set('todos',
        //     $this->paginate($this->Todos->find(
        //         'ApiIndex',
        //         ['user_id' => 1]
        //         // ['user_id' => $this->Auth->user('id')]
        //     ))
        // );
        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('todo', $todo);
        return $this->Crud->execute();
    }

    public function add()
    {
        $this->Crud->on('beforeSave', function(\Cake\Event\Event $event) {
            $event->subject->entity['user_id'] = $this->Auth->User('id');
        });
        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    public function edit($id = null)
    {
        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            if ($event->subject->success) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'title' => $event->subject->entity->title,
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    public function delete($id = null)
    {
        return $this->Crud->execute();
    }
}
