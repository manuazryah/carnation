<?php

use yii\db\Migration;

class m170811_045410_product_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        //tbl_category
//        $this->createTable('{{%product}}', [
//            'id' => $this->primaryKey(),
//            'category' => $this->integer(),
//            'subcategory' => $this->integer(),
//            'product_name' => $this->string(100)->notNull(),
//            'canonical_name' => $this->string(100)->notNull()->unique(),
//            'item_ean' => $this->string()->notNull()->unique(),
//            'brand' => $this->string()->notNull(),
//            'gender_type' => $this->integer(),
//            'price' => $this->decimal(10, 2)->notNull(),
//            'offer_price' => $this->decimal(10, 2),
//            'currency' => $this->integer()->notNull(),
//            'stock' => $this->integer()->notNull(),
//            'stock_unit' => $this->integer()->notNull(),
//            'tax' => $this->integer()->notNull(),
//            'free_shipping' => $this->integer()->comment('"1"=>"Yes", "0"=>"No"'),
//            'product_type' => $this->string()->notNull(),
//            'size' => $this->integer(),
//            'size_unit' => $this->integer(),
//            'main_description' => $this->text()->notNull(),
//            'product_detail' => $this->text()->notNull(),
//            'condition' => $this->integer()->comment('"1"=>"New", "0"=>"refurbished"'),
//            'CB' => $this->integer(),
//            'UB' => $this->integer(),
//            'DOC' => $this->dateTime(),
//            'DOU' => $this->timestamp(),
//            'status' => $this->integer()->notNull()->defaultValue(1),
//            'profile'=>$this->string()->notNull(),
//            'other_image'=>$this->string(),
//                ], $tableOptions);
//        $this->insert('product', ['id' => '1','category' => '1','subcategory'=>'1','product_name'=>'Coral Blu M EDP 100ML','canonical_name'=>'coral-blu-m-edp-100ml',
//            'item_ean'=>'2017-03-10','brand'=>'Coral','gender_type'=>'1','price'=>'2','offer_price'=>'1','currency'=>'1','stock'=>'55',
//            'stock_unit'=>'1','tax'=>'0..5','free_shipping'=>'1','product_type'=>'','size'=>'5','size_unit'=>'1','main_description'=>'Waiting',
//            'product_detail'=>'Waiting','condition'=>'1','CB'=>'1','DOC'=>date('Y-m-d')]);
//        $this->insert('product', ['id' => '2','category' => '1','subcategory'=>'1','product_name'=>'Coral Escape Pour Femme Eau De Parfum','canonical_name'=>'coral-escape-pour-femme-eau-de-parfum',
//            'item_ean'=>'2017-403-10','brand'=>'Coral','gender_type'=>'1','price'=>'2','offer_price'=>'1','currency'=>'1','stock'=>'55',
//            'stock_unit'=>'1','tax'=>'0..5','free_shipping'=>'1','product_type'=>'','size'=>'5','size_unit'=>'1','main_description'=>'Waiting',
//            'product_detail'=>'Waiting','condition'=>'1','CB'=>'1','DOC'=>date('Y-m-d')]);
//            
//        $this->addColumn('product', 'meta_title', 'string(200) after canonical_name');    
//        $this->addColumn('product', 'meta_description', 'text after meta_title');    
//        $this->addColumn('product', 'meta_keywords', 'text after meta_description');    
//        $this->addColumn('product', 'search_tag', 'string(250) after meta_keywords');    
//        $this->addColumn('product', 'profile_alt', 'string(250) after profile');
//        $this->addColumn('product', 'gallery_alt', 'string(250) after profile_alt');
//        $this->addColumn('product', 'stock_availability', $this->Integer()->defaultValue(1)->after('stock_unit') );

//        $this->createTable('{{%master_search_tag}}', [
//            'id' => $this->primaryKey(),
//            'tag_name' => $this->string()->notNull()->unique(),
//            'CB' => $this->integer(),
//            'UB' => $this->integer(),
//            'DOC' => $this->dateTime(),
//            'DOU' => $this->timestamp(),
//            'status' => $this->integer()->notNull()->defaultValue(1),
//                ], $tableOptions);

//        $this->createTable('{{%cart}}', [
//            'id' => $this->primaryKey(),
//            'user_id' => $this->integer(),
//            'session_id' => $this->string(225),
//            'product_id' => $this->integer(),
//            'quantity' => $this->integer(),
//            'options' => $this->integer(),
//            'date' => $this->dateTime(),
//            'gift_option' => $this->integer(),
//            'rate' => $this->double(),
//                ], $tableOptions);
//                        
//        $this->createTable('{{%unit}}', [
//            'id' => $this->primaryKey(),
//            'unit_name' => $this->string()->notNull()->unique(),
//            'CB' => $this->integer(),
//            'UB' => $this->integer(),
//            'DOC' => $this->dateTime(),
//            'DOU' => $this->timestamp(),
//            'status' => $this->integer()->notNull()->defaultValue(1),
//                ], $tableOptions);
//        
//        $this->createTable('{{%currency}}', [
//            'id' => $this->primaryKey(),
//            'currency_name' => $this->string()->notNull()->unique(),
//            'currency_symbol' => $this->string()->notNull()->unique(),
//            'currency_value' => $this->string(),
//            'CB' => $this->integer(),
//            'UB' => $this->integer(),
//            'DOC' => $this->dateTime(),
//            'DOU' => $this->timestamp(),
//            'status' => $this->integer()->notNull()->defaultValue(1),
//                ], $tableOptions);
    }

    public function safeDown() {
        echo "m170811_045410_product_table cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m170811_045410_product_table cannot be reverted.\n";

      return false;
      }
     */
}
