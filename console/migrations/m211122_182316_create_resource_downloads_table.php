<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_downloads}}`.
 */
class m211122_182316_create_resource_downloads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_downloads}}', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
            'count' => $this->integer()
        ]);
        $this->addForeignKey('fk-resource_downloads-resource_id', 'resource_downloads', 'resource_id', 'resource', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_downloads}}');
    }
}
