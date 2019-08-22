<?php

use app\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%hall}}`.
 */
class m190822_104954_create_hall_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%hall}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
        ], $this->getTableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%hall}}');
    }
}
