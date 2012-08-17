<?php

class m120817_115745_catalogue extends CDbMigration
{
        public function up()
	{
           $this->createTable('{{category}}', array(
                'id' => 'pk',
                'parent_id' => 'int',
                'sorting' => 'int',
                'title' => 'varchar (255) NOT NULL',
            ));

            $this->createTable('{{product}}', array(
                'id' => 'pk',
                'title' => 'varchar (255) NOT NULL',
                'short_description' => 'text NOT NULL',
            ));
            
            $this->createTable('{{product_description}}', array(
                'id' => 'pk',
                'product_id' => 'int',
                'description' => 'text NOT NULL',
            ));
            
            $this->createTable('{{category_to_product}}', array(
                'product_id' => 'int',
                'category_id' => 'int',
                'PRIMARY KEY (`product_id`, `category_id`)',
            ));
                        
            $this->addForeignKey("parent_category", "{{category}}", "parent_id", "{{category}}", "id");
            $this->addForeignKey("product_description", "{{product_description}}", "product_id", "{{product}}", "id");
            
            $this->addForeignKey("product_product", "{{category_to_product}}", "product_id", "{{product}}", "id");
            $this->addForeignKey("category_category", "{{category_to_product}}", "category_id", "{{category}}", "id");
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