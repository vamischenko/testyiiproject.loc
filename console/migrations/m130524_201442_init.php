<?php

use common\db\mysql\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'company_id' => $this->integer(),
            'icon' => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
//            'files' => Schema::TYPE_TEXT_ARRAY,
            'files' => $this->json(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()
        ]);
        $this->execute("INSERT INTO `company`(`id`, `name`, `status`) VALUES (1, 'test', 1)");
        $this->execute("INSERT INTO `company`(`id`, `name`, `status`) VALUES (2, 'test1', 1)");
        $this->execute("INSERT INTO `company`(`id`, `name`, `status`) VALUES (3, 'test2', 1)");
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%company}}');
    }
}
