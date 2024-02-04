<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%resource_images}}`.
 */
class m240202_203648_add_name_column_to_resource_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addColumn('{{%resource_images}}', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropColumn('{{%resource_images}}', 'name');
    }
}
