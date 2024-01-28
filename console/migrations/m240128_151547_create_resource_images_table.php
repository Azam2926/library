<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_images}}`.
 */
class m240128_151547_create_resource_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_images}}', [
            'id' => $this->primaryKey(),
            'resource_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-resource_images-resource_id',
            'resource_images',
            'resource_id'
        );

        $this->addForeignKey(
            'fk-resource_images-resource_id',
            'resource_images',
            'resource_id',
            'resource',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-resource_images-resource_id',
            'resource_images'
        );

        $this->dropIndex(
            'idx-resource_images-resource_id',
            'resource_images'
        );

        $this->dropTable('{{%resource_images}}');
    }
}
