<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m240121_190145_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'resource_id' => $this->integer()->notNull(),
            'rating' => $this->integer(),
            'comment' => $this->text(),
            'status' => $this->integer(),
            'created_at' => $this->timestamp()
        ]);

        $this->addForeignKey('fk-reviews-user_id', 'reviews', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk-reviews-resource_id', 'reviews', 'resource_id', '{{%resource}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
    }
}
