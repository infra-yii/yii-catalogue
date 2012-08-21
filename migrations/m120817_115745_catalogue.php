<?php

class m120817_115745_catalogue extends CDbMigration
{
        public function up()
	{
           $this->createTable('{{category}}', array(
                'id' => 'pk',
                'parent_id' => 'int',
                'sorting' => 'tinyint(3)',
                'title' => 'varchar (200) NOT NULL',
            ));

            $this->createTable('{{product}}', array(
                'id' => 'pk',
                'title' => 'varchar (200) NOT NULL',
                'short_description' => 'tinytext NOT NULL',
            ));
            
            $this->createTable('{{product_info}}', array(
                'id' => 'pk',
                'product_id' => 'int',
                'description' => 'text DEFAULT NULL',
                'UNIQUE KEY `product_id` (`product_id`)',
            ));
            
            $this->createTable('{{category_to_product}}', array(
                'product_id' => 'int',
                'category_id' => 'int',
                'PRIMARY KEY (`product_id`, `category_id`)',
            ));
                        
            $this->addForeignKey("parent_category", "{{category}}", "parent_id", "{{category}}", "id",null,"CASCADE");
            $this->addForeignKey("product_description", "{{product_info}}", "product_id", "{{product}}", "id", "CASCADE", "CASCADE");
            
            $this->addForeignKey("product_product", "{{category_to_product}}", "product_id", "{{product}}", "id", "CASCADE", "CASCADE");
            $this->addForeignKey("category_category", "{{category_to_product}}", "category_id", "{{category}}", "id", "CASCADE", "CASCADE");
	}

	public function down()
	{
                $this->dropTable('{{category}}');
                $this->dropTable('{{product}}');
                $this->dropTable('{{product_description}}');
                $this->dropTable('{{category_to_product}}');
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}