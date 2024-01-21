<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%resource}}`.
 */
class m240121_184617_add_column_to_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('resource', 'price', $this->float());
        $this->addColumn('resource', 'discount_type', $this->string());
        $this->addColumn('resource', 'discount_value', $this->float());
        $this->addColumn('resource', 'count', $this->integer());
        $this->addColumn('resource', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('resource', 'price');
        $this->dropColumn('resource', 'discount_type');
        $this->dropColumn('resource', 'discount_value');
        $this->dropColumn('resource', 'count');
        $this->dropColumn('resource', 'status');
    }
}
