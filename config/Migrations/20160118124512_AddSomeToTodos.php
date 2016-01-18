<?php
use Migrations\AbstractMigration;

class AddSomeToTodos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('todos');
        $table->addColumn('priority', 'integer', [
            'default' => 3,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('done', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
