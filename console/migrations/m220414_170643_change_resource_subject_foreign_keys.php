<?php

use yii\db\Migration;

/**
 * Class m220414_170643_change_resource_subject_foreign_key
 */
class m220414_170643_change_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Change foreign resource-subject key
        $this->dropForeignKey('fk-resource-subject_id', 'resource');
        $this->addForeignKey('fk-resource-subject_id', 'resource', 'subject_id', 'subject', 'id', 'CASCADE');

        //Change foreign resource-views key
        $this->dropForeignKey('fk-resource_views-resource_id', 'resource_views');
        $this->addForeignKey('fk-resource_views-resource_id', 'resource_views', 'resource_id', 'resource', 'id', 'CASCADE');

        // Change foreign resource-downloads key
        $this->dropForeignKey('fk-resource_downloads-resource_id', 'resource_downloads');
        $this->addForeignKey('fk-resource_downloads-resource_id', 'resource_downloads', 'resource_id', 'resource', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "reverting changes\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220414_170643_change_resource_subject_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
