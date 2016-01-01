<?php
namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\UsersController;
use Cake\TestSuite\IntegrationTestCase;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

use JwtUtilTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.todos'
    ];

    /**
     * Test Authentication
     *
     * @return void
     */
    public function testUnauthenticated() {
        $this->get('/api/users/index.json');
        $this->assertResponseCode(401);
        $this->get('/api/users/view/1.json');
        $this->assertResponseCode(401);
        $this->post('/api/users/add', ['username'=>'testuser']);
        $this->assertResponseCode(401);
        $this->put('/api/users/edit/1', ['username'=>'testuser']);
        $this->assertResponseCode(401);
        $this->delete('/api/users/delete/1');
        $this->assertResponseCode(401);
    }


    public function testInvalidUser() {
        $this->setupUser();
        $user = [
            'username'=>'error',
            'password'=>''
        ];
        $this->post('/api/users/token.json', $user);
        $this->assertResponseError();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex() {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->get('/api/users/index.json');
        $this->assertResponseOk();
        $this->assertContentType('application/json');
        // var_dump(json_decode($this->_response->body(), true));
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView() {

        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->get('/api/users/view/1.json');
        $this->assertResponseOk();
        $this->assertContentType('application/json');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd() {

        $users = TableRegistry::get('Users');
        $before = $users->find()->all()->count();

        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->post('/api/users/register', ['username'=>'testuser2', 'password'=>'pwd', 'active'=>true]);
        $this->assertResponseOk();
        $this->assertContentType('application/json');
        $this->assertTrue($this->getApiResult('success'));
        // var_dump(json_decode($this->_response->body(), true));

        $this->assertEquals($before + 1,  $users->find()->all()->count());

    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit() {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->put('/api/users/edit/1.json', ['username'=>'testuser2']);
        $this->assertResponseOk();
        // var_dump(json_decode($this->_response->body(), true));
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete() {
        $token = $this->getToken();
        $this->setTokenToHeader($token);
        $this->delete('/api/users/delete/1');
        $this->assertResponseOk();
        // var_dump(json_decode($this->_response->body(), true));
    }
}
