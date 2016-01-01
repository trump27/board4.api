<?php
namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\AppController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * App\Controller\TodosController Test Case
 */
class TodosControllerTest extends IntegrationTestCase
{

use JwtUtilTrait;

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
        $this->get('/api/todos/index.json');
        $this->assertResponseCode(401);
        $this->get('/api/todos/view/1.json');
        $this->assertResponseCode(401);
        $this->post('/api/todos/add', ['title'=>'test-title']);
        $this->assertResponseCode(401);
        $this->put('/api/todos/edit/1', ['title'=>'test-title2']);
        $this->assertResponseCode(401);
        $this->delete('/api/todos/delete/1');
        $this->assertResponseCode(401);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex() {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->get('/api/todos/index.json');
        $this->assertResponseOk();
        $this->assertContentType('application/json');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView() {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->get('/api/todos/view/1.json');
        $this->assertResponseOk();
        $this->assertContentType('application/json');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd() {

        $todos = TableRegistry::get('Todos');
        $before = $todos->find()->all()->count();

        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->post('/api/todos/add', ['user_id'=>1, 'title'=>'test title']);
        $this->assertResponseOk();
        $this->assertContentType('application/json');
        $this->assertTrue($this->getApiResult('success'));

        $this->assertEquals($before + 1,  $todos->find()->all()->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit() {

        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->put('/api/todos/edit/1.json', ['title'=>'title update']);
        $this->assertResponseOk();
        $this->assertContentType('application/json');
        // $result = $this->getApiResult();

    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->delete('/api/todos/delete/1.json');
        $this->assertResponseOk();
        $this->assertContentType('application/json');

        // for force test
        $this->getApiResult();
    }

}
