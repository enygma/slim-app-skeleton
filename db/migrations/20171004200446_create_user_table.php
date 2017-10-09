<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string')
            ->addColumn('user_id', 'integer')
            ->addColumn('email', 'string')
            ->addColumn('bio', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime');

        $table->save();
    }
}
