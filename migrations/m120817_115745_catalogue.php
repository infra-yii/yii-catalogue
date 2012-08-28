<?php

class m120817_115745_catalogue extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{catalogue_category}}', array(
            'id' => 'pk',
            'parent_id' => 'int DEFAULT NULL',
            'sorting' => 'tinyint(3)',
            'title' => 'varchar (200) NOT NULL',
        ));

        $this->createTable('{{catalogue_product}}', array(
            'id' => 'pk',
            'title' => 'varchar (200) NOT NULL',
            'short_description' => 'tinytext NOT NULL',
        ));

        $this->createTable('{{catalogue_product_info}}', array(
            'id' => 'pk',
            'product_id' => 'int',
            'description' => 'text DEFAULT NULL',
            'UNIQUE KEY `product_id` (`product_id`)',
        ));

        $this->createTable('{{catalogue_category_to_product}}', array(
            'product_id' => 'int',
            'category_id' => 'int',
            'PRIMARY KEY (`product_id`, `category_id`)',
        ));

        $this->addForeignKey("catalogue_parent_category", "{{catalogue_category}}", "parent_id", "{{catalogue_category}}", "id", null, "CASCADE");
        $this->addForeignKey("catalogue_product_description", "{{catalogue_product_info}}", "product_id", "{{catalogue_product}}", "id", "CASCADE", "CASCADE");

        $this->addForeignKey("catalogue_product_product", "{{catalogue_category_to_product}}", "product_id", "{{catalogue_product}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("catalogue_category_category", "{{catalogue_category_to_product}}", "category_id", "{{catalogue_category}}", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropTable('{{catalogue_category}}');
        $this->dropTable('{{catalogue_product}}');
        $this->dropTable('{{catalogue_product_description}}');
        $this->dropTable('{{catalogue_category_to_product}}');
        return false;
    }
}