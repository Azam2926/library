<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%resource_downloads}}`.
 */
class m240128_144643_drop_resource_downloads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%resource_downloads}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%resource_downloads}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
