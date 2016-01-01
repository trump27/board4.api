<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TodosController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * App\Controller\TodosController Test Case
 */
class TodosControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.todos',
        'app.users'
    ];

    public function testUnauthenticated() {
        $this->get('/todos/index');
        $this->assertResponseCode(302);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
        $this->get('/todos/view/1');
        $this->assertResponseCode(302);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
        $this->post('/todos/add', ['title'=>'test title']);
        $this->assertResponseCode(302);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
        $this->put('/todos/edit/1', ['title'=>'test title']);
        $this->assertResponseCode(302);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
        $this->delete('/todos/delete/1');
        $this->assertResponseCode(302);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex() {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/todos/index');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView() {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/todos/view/1');
        $this->assertResponseOk();
        $this->assertTemplate('view');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd() {

        $todos = TableRegistry::get('Todos');
        $before = $todos->find()->all()->count();

        $this->session(['Auth.User.id' => 1]);
        $this->post('/todos/add', ['user_id'=>1, 'title'=>'test title']);
        $this->assertRedirect(['controller' => 'Todos', 'action' => 'index']);
        $this->post('/todos/add', ['user_id'=>1, 'title'=>null]);
        $this->assertResponseOk();
        $this->assertTemplate('add');

        $this->assertEquals($before + 1,  $todos->find()->all()->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit() {
        $this->session(['Auth.User.id' => 1]);
        $this->put('/todos/edit/1', ['title'=>'title update']);
        $this->assertRedirect(['controller' => 'Todos', 'action' => 'index']);
        $this->put('/todos/edit/1', ['title'=>null]);
        $this->assertResponseOk();
        $this->assertTemplate('edit');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session(['Auth.User.id' => 1]);

        $todos = TableRegistry::get('Todos');

        $stopEvent = function(Event $event) { $event->stopPropagation(); };
        $todos->eventManager()->on('Model.beforeDelete', $stopEvent);
        // $todos->eventManager()->on('Model.beforeDelete', function ($event) {
        //     $event->stopPropagation(); // stop delete
        // });

        $this->delete('/todos/delete/1');
        $data = $todos->find()->where(['id' => 1]);
        $this->assertEquals(1, $data->count()); // not deleted
        $this->assertResponseSuccess();

        $todos->eventManager()->off('Model.beforeDelete', $stopEvent);

        $this->delete('/todos/delete/1');
        $data = $todos->find()->where(['id' => 1]);
        $this->assertEquals(0, $data->count());
        $this->assertRedirect(['controller' => 'Todos', 'action' => 'index']);

    }
}
