<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%subject}}`.
 */
class m240121_182947_add_column_to_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('subject', 'parent_id', $this->integer());
        $this->addColumn('subject', 'slug', $this->text());
        $this->addColumn('subject', 'description', $this->text());
        $this->addColumn('subject', 'created_at', $this->timestamp());
        $this->addColumn('subject', 'updated_at', $this->timestamp());
        $this->addForeignKey('fk-subject-parent_id', 'subject', 'parent_id', 'subject', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('subject', 'parent_id');
        $this->dropColumn('subject', 'slug');
        $this->dropColumn('subject', 'description');
        $this->dropColumn('subject', 'created_at');
        $this->dropColumn('subject', 'updated_at');
        $this->dropForeignKey('fk-subject-parent_id', 'subject');
    }
}
