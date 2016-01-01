<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'autoIncrement' => true, 'precision' => null, 'comment' => null],
        'username' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'precision' => null, 'comment' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'precision' => null, 'comment' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'precision' => null, 'comment' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'precision' => null, 'comment' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'username' => 'testuser',
            'password' => 'testuser',
            'active' => 1,
            'created' => '2015-12-27 18:00:11',
            'modified' => '2015-12-27 18:00:11'
        ],
    ];
}
