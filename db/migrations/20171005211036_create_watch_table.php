<?php

use Phinx\Migration\AbstractMigration;

class CreateWatchTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('watch');
        $table->addColumn('username', 'string')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime');

        $table->save();
    }
}
