<?php

use yii\db\Migration;

class m171102_113445_agenda extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
        }
            $this->createTable('contact', [
                'id' => $this->primaryKey(),
                'username' => $this->string(32)->notNull(),
                ], $tableOptions);
    }

    public function safeDown()
    {
            $this->dropTable('contact');
         // echo "m171102_113445_agenda cannot be reverted.\n";
       // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171102_113445_agenda cannot be reverted.\n";

        return false;
    }
    */
}
