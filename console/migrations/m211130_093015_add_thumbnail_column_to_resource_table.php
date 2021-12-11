<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%resource}}`.
 */
class m211130_093015_add_thumbnail_column_to_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resource', 'thumbnail', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('resource', 'thumbnail');
    }
}
