<?php

use Phinx\Migration\AbstractMigration;

class CreateTargetTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('target');
        $table->addColumn('connector_id', 'integer')
            ->addColumn('watch_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime');

        $table->save();
    }
}
