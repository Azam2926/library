<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_items}}`.
 */
class m240121_193738_create_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_items}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'resource_id' => $this->integer()->notNull(),
            'price' => $this->float(),
            'quantity' => $this->integer(),
            'created_at' => $this->timestamp()
        ]);

        $this->addForeignKey('fk-cart_items-cart_id', 'cart_items', 'cart_id', '{{%carts}}', 'id');
        $this->addForeignKey('fk-cart_items-resource_id', 'cart_items', 'resource_id', '{{%resource}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart_items}}');
    }
}
