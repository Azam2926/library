<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_views}}`.
 */
class m211122_182251_create_resource_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_views}}', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
            'count' => $this->integer()
        ]);

        $this->addForeignKey('fk-resource_views-resource_id', 'resource_views', 'resource_id', 'resource', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_views}}');
    }
}
