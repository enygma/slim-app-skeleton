<?php

use Phinx\Migration\AbstractMigration;

class CreateLiveTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('live');
        $table->addColumn('watch_id', 'integer')
            ->addColumn('start_time', 'datetime')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime');

        $table->save();
    }
}
