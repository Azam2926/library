<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_shower}}`.
 */
class m240123_162847_create_resource_shower_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_shower}}', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-resource_shower-resource_id', 'resource_shower', 'resource_id', '{{%resource}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_shower}}');
    }
}
