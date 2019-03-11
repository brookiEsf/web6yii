<?php

use yii\db\Migration;

/**
 * Class m190218_073214_images
 */
class m190218_073214_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        }
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'image_type' => $this->string(25)->notNull(),
            'date_created' => $this->timestamp()->defaultValue(null),
            'image' => $this->binary()->notNull(),
            'alt' => $this->string(255)->notNull(),
            'image_size' => $this->string(25)->notNull()->defaultValue(0),
            'image_category' => $this->string(255)->notNull(),
            'image_name' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190218_073214_images cannot be reverted.\n";

        return false;
    }
    */
}
