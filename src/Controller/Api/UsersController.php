<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // $this->Auth->allow(['add', 'token']);
        $this->Auth->allow(['token']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->Crud->disable(['Edit', 'Delete', 'Index', 'view']);
    }

    /**
     * Create new user and return id plus JWT token
     */
    public function add()
    {
        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => JWT::encode(
                        [
                            'sub' => $event->subject->entity->id,
                            'exp' =>  time() + 604800
                        ],
                        Security::salt()
                    )
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    /**
     * Return JWT token if posted user credentials pass FormAuthenticate
     */
    public function token()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        $this->set([
            'success' => true,
            'data' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'token' => JWT::encode(
                    [
                        'sub' => $user['id'],
                        'exp' =>  time() + 604800
                    ],
                    Security::salt()
                )
            ],
            '_serialize' => ['success', 'data']
        ]);
    }

    public function index()
    {
        // $this->Crud->on('beforePaginate', function(\Cake\Event\Event $event) {
        //     $this->paginate['finder'] = 'ApiIndex';
        // });
        // $this->set('users', $this->paginate($this->Users->find('ApiIndex')));
        // $this->Crud->action()->findMethod('ApiIndex');
        return $this->Crud->execute();

        // $this->set('users', $this->paginate($this->Users));
        // $this->set('_serialize', ['users']);
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null)
    {
        $this->Crud->on('afterSave', function(\Cake\Event\Event $event) {
            if ($event->subject->success) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'username' => $event->subject->entity->username,
                    'active' => $event->subject->entity->active
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }

    public function delete($id = null)
    {
        // $this->Crud->on('afterDelete', function(\Cake\Event\Event $event) {
        //     // if (!$event->subject->success) {
        //     //     $this->set('data', [
        //     //         'id' => $id
        //     //     ]);
        //     // }
        // });
        return $this->Crud->execute();
    }
}
