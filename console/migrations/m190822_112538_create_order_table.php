<?php

use app\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190822_112538_create_order_table extends Migration
{
    use MigrationTrait;
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'place_id' => $this->integer()->notNull(),
            'movie_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ], $this->getTableOptions());

        // creates index and fk for column `place_id`
        $this->createIndex(
            'idx-order-place_id',
            '{{%order}}',
            'place_id'
        );
        $this->addForeignKey(
            'fk-order-place_id',
            '{{%order}}',
            'place_id',
            '{{%film}}',
            'id',
            'CASCADE'
        );

        // creates index and fk for column `movie_id`
        $this->createIndex(
            'idx-order-movie_id',
            '{{%order}}',
            'movie_id'
        );
        $this->addForeignKey(
            'fk-order-movie_id',
            '{{%order}}',
            'movie_id',
            '{{%movie}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key and index for column `movie_id`
        $this->dropForeignKey(
            'fk-order-movie_id',
            '{{%order}}'
        );
        $this->dropIndex(
            'idx-order-movie_id',
            '{{%order}}'
        );

        // drops foreign key and index for column `place_id`
        $this->dropForeignKey(
            'fk-order-place_id',
            '{{%order}}'
        );
        $this->dropIndex(
            'idx-order-place_id',
            '{{%order}}'
        );

        $this->dropTable('{{%order}}');
    }
}
