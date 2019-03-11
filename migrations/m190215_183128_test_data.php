<?php

use yii\db\Migration;

/**
 * Class m190215_183128_test_data
 */
class m190215_183128_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%users}}', [
            'username' => 'grudik',
            'password' => 'password',
            'email' => 'email',
            'status' => '10',
            'created_at' => date('y-m-d h:i:s'),
            'updated_at' => date('y-m-d h:i:s'),
            'auth_key' => 'qwerty',
            'password_reset_token' => 'qwerty'
        ]);
        $this->batchInsert('{{%users}}', ['username', 'password', 'email', 'status', 'created_at', 'updated_at', 'auth_key', 'password_reset_token'],
            [
                ['grudik1', 'password1', 'email1', 10, date('y-m-d h:i:s'), date('y-m-d h:i:s'), 'sdfghj', 'sdfghj'],
                ['grudik2', 'password1', 'email2', 10, date('y-m-d h:i:s'), date('y-m-d h:i:s'), 'sdfghj2', 'sdfghj2'],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%users}}', '`id` in (1,2,3)');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190215_183128_test_data cannot be reverted.\n";

        return false;
    }
    */
}
