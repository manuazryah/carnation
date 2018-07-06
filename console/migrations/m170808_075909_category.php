<?php

use yii\db\Migration;

class m170808_075909_category extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        //tbl_category
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string()->notNull()->unique(),
            'CB' => $this->integer(),
            'UB' => $this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
            'status' => $this->integer()->notNull()->defaultValue(1),
                ], $tableOptions);
        //tbl_sub_category
        $this->createTable('{{%sub_category}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'sub_category' => $this->string(200)->notNull()->unique(),
            'CB' => $this->integer(),
            'UB' => $this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
                ], $tableOptions);
        $this->addForeignKey("fk_category_name_id", "sub_category", "category_id", "category", "id", "RESTRICT", "RESTRICT");
        //tbl admin_post
        $this->createTable('{{%admin_post}}', [
            'id' => $this->primaryKey(),
            'post_name' => $this->string()->notNull()->unique(),
            'admin' => $this->string()->notNull(),
            'CB' => $this->integer(),
            'UB' => $this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
                ], $tableOptions);
        //tbl_admin_user
        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_name' => $this->string(200)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(200)->notNull(),
            'password_reset_token' => $this->string(255)->notNull(),
            'name' => $this->string(200)->notNull(),
            'email' => $this->string(200)->notNull()->unique(),
            'phone' => $this->string(20)->notNull(),
            'CB' => $this->integer(),
            'UB' => $this->integer(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
                ], $tableOptions);
        $this->addForeignKey("fk_admin_post_id", "admin_user", "post_id", "admin_post", "id", "RESTRICT", "RESTRICT");
        //
    }

    public function safeDown() {
        echo "m170808_075909_category cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m170808_075909_category cannot be reverted.\n";

      return false;
      }
     */
}
