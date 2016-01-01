<?php
namespace App\Test\TestCase\Controller\Api;

use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

/**
 * App\Controller\UsersController Test Case
 */
trait JwtUtilTrait
{

    public $user_id = 1;
    public $username = 'testuser';
    public $password = 'testuser';

    public function setupUser() {
        $users = TableRegistry::get('Users');
        $users->query()
            ->update()
            ->set([
                'username' => $this->username,
                'password' => (new DefaultPasswordHasher)->hash('testuser')
            ])
            ->where(['id' => $this->user_id ])
            ->execute();
    }

    /**
     * Jwt-Tokenを取得
     */
    public function getToken() {
        $this->setupUser();
        $user = [
            'username'=>$this->username,
            'password'=>$this->password
        ];
        $this->post('/api/users/token.json', $user);
        return $this->getApiResult('token');
    }

    public function setTokenToHeader($token) {
        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ]);
    }

    /**
     * Apiの結果取得
     */
    public function getApiResult($kind='token') {
        $result = json_decode($this->_response->body(), true);
        // $result = json_decode($this->_response->body());
        if (!$result)
            $result = $this->_response->body();
        if ($kind=='token' && !empty($result['data']['token']))
            return $result['data']['token'];
        elseif ($kind=='success' && !empty($result['success']))
            return $result['success'];
        else
            return $result;
    }
}
