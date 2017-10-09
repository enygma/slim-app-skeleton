<?php

use Phinx\Migration\AbstractMigration;

class CreateConnectorTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('connector');
        $table->addColumn('user_id', 'integer')
            ->addColumn('type', 'string')
            ->addColumn('configuration', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime');

        $table->save();
    }
}
