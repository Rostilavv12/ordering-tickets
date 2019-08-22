<?php

use app\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%seat}}`.
 */
class m190822_112019_create_seat_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%seat}}', [
            'id' => $this->primaryKey(),
            'row' => $this->tinyInteger(),
            'number' => $this->tinyInteger(),
        ], $this->getTableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%seat}}');
    }
}
