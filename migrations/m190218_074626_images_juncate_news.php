<?php

use yii\db\Migration;

/**
 * Class m190218_074626_images_juncate_news
 */
class m190218_074626_images_juncate_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-news_image_id-images_id',
            '{{%news}}',
            'image_id'
        );
        $this->addForeignKey(
            'fk-news_image_id-images_id',
            '{{%news}}',
            'image_id',
            '{{%images}}',
            'id'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-news_image_id-images_id', '{{%news}}');
        $this->dropIndex('idx-news_image_id-images_id', '{{%news}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190218_074626_images_juncate_news cannot be reverted.\n";

        return false;
    }
    */
}
