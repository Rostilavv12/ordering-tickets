<?php

use app\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%movie}}`.
 */
class m190822_111109_create_movie_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movie}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
        ], $this->getTableOptions());

        // creates index for column `film_id`
        $this->createIndex(
            'idx-movie-film_id',
            '{{%movie}}',
            'film_id'
        );

        // add foreign key for table `film`
        $this->addForeignKey(
            'fk-movie-film_id',
            '{{%movie}}',
            'film_id',
            '{{%film}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `movie`
        $this->dropForeignKey(
            'fk-movie-film_id',
            '{{%movie}}'
        );

        // drops index for column `film_id`
        $this->dropIndex(
            'idx-movie-film_id',
            '{{%movie}}'
        );
        
        $this->dropTable('{{%movie}}');
    }
}
