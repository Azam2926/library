<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_list}}`.
 */
class m240121_194117_create_order_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_list}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'resource_id' => $this->integer()->notNull(),
            'price' => $this->float(),
            'quantity' => $this->integer(),
            'created_at' => $this->timestamp()
        ]);

        $this->addForeignKey('fk-order_list-order_id', 'order_list', 'order_id', '{{%order}}', 'id');
        $this->addForeignKey('fk-order_list-resource_id', 'order_list', 'resource_id', '{{%resource}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_list}}');
    }
}
