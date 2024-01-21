<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m240121_193335_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()
        ]);

        $this->addForeignKey('fk-order-user_id', 'order', 'user_id', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
