<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%resource}}`.
 */
class m211124_125649_add_file_column_to_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%resource}}', 'file', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%resource}}', 'file');
    }
}
