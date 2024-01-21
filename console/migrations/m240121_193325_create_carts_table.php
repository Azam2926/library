<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carts}}`.
 */
class m240121_193325_create_carts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carts}}', [
            'id' => $this->primaryKey(),
            'created_by' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carts}}');
    }
}
