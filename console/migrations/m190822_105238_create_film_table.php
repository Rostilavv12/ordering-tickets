<?php

use app\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%film}}`.
 */
class m190822_105238_create_film_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%film}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'price' => $this->integer()->notNull(),
        ], $this->getTableOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%film}}');
    }
}
