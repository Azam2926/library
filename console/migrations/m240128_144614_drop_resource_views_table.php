<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%resource_views}}`.
 */
class m240128_144614_drop_resource_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%resource_views}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%resource_views}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
