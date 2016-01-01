<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.todos'
    ];

    public function testUnauthenticated() {
        $this->get('/users/index');
        $this->assertResponseCode(302);
        $this->get('/users/view/1');
        $this->assertResponseCode(302);
        $this->post('/users/add', ['username'=>'testuser']);
        $this->assertResponseCode(302);
        $this->put('/users/edit/1', ['username'=>'testuser']);
        $this->assertResponseCode(302);
        $this->delete('/users/delete/1');
        $this->assertResponseCode(302);
    }

    public function testLogin() {
        $this->session(['Auth.User.id' => 1]);
        $this->post('/users/add', ['username'=>'logintest', 'password'=>'logintest', 'active'=>true]);
        $this->assertResponseCode(302);
        $this->get('/users/logout');

        $this->post('/users/login', ['username'=>'XXXX', 'password'=>'logintest']);
        $this->assertTemplate('login');
        $this->assertResponseContains('incorrect');
        $this->post('/users/login', ['username'=>'logintest', 'password'=>'logintest']);
        $this->assertResponseCode(302);
    }

    public function testLogout() {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/users/logout');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }
    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex() {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/users/index');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView() {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/users/view/1');
        $this->assertResponseOk();
        $this->assertTemplate('view');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd() {

        $users = TableRegistry::get('Users');
        $before = $users->find()->all()->count();

        $this->session(['Auth.User.id' => 1]);
        $this->post('/users/add', ['username'=>'testuser2', 'password'=>'pwd', 'active'=>true]);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'index']);
        $this->post('/users/add', ['username'=>null]);
        $this->assertResponseOk();
        $this->assertTemplate('add');

        $this->assertEquals($before + 1,  $users->find()->all()->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit() {
        $this->session(['Auth.User.id' => 1]);
        $this->put('/users/edit/1', ['username'=>'testuser3', 'password'=>'pwd']);
        $this->assertRedirect(['controller' => 'Users', 'action' => 'index']);
        $this->put('/users/edit/1', ['username'=>null]);
        $this->assertResponseOk();
        $this->assertTemplate('edit');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete() {
        $this->session(['Auth.User.id' => 1]);

        $users = TableRegistry::get('Users');

        $stopEvent = function(Event $event) { $event->stopPropagation(); };
        $users->eventManager()->on('Model.beforeDelete', $stopEvent);

        $this->delete('/users/delete/1');
        $data = $users->find()->where(['id' => 1]);
        $this->assertEquals(1, $data->count()); // not deleted
        $this->assertResponseSuccess();

        $users->eventManager()->off('Model.beforeDelete', $stopEvent);

        $this->delete('/users/delete/1');
        $data = $users->find()->where(['id' => 1]);
        $this->assertEquals(0, $data->count());
        $this->assertRedirect(['controller' => 'Users', 'action' => 'index']);
    }
}
