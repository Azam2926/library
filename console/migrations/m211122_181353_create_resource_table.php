<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource}}`.
 */
class m211122_181353_create_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource}}', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(36)->notNull()->unsigned()->unique(),
            'subject_id' => $this->integer()->notNull(),
            'type_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'file' => $this->string(),
            'publisher' => $this->string(),
            'date' => $this->string(),
            'language' => $this->tinyInteger(),
            'type' => $this->tinyInteger(),
            'open_access' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-resource-subject_id', 'resource', 'subject_id', '{{%subject}}', 'id');
        $this->addForeignKey('fk-resource-type_id', 'resource', 'type_id', '{{%type}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource}}');
    }
}
