<?php

class m120823_110631_properties extends EDbMigration
{
	public function up()
	{
        $this->createTable('{{catalogue_property}}', array(
            'id' => 'pk',
            'title' => 'varchar (255) NOT NULL',
        ));

        $this->createTable('{{catalogue_property_value}}', array(
            'id' => 'pk',
            'product_id' => 'int',
            'property_id' => 'int',
            'value' => 'varchar (255) NOT NULL',
        ));

        $this->createTable('{{catalogue_property_to_category}}', array(
            'property_id' => 'int',
            'category_id' => 'int',
            'PRIMARY KEY (`property_id`, `category_id`)',
        ));

        $this->addForeignKey("catalogue_product_property_value", "{{catalogue_property_value}}", "product_id", "{{catalogue_product}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("catalogue_property", "{{catalogue_property_value}}", "property_id", "{{catalogue_property}}", "id", "CASCADE", "CASCADE");

        $this->addForeignKey("catalogue_property_property", "{{catalogue_property_to_category}}", "property_id", "{{catalogue_property}}", "id", "CASCADE", "CASCADE");
        $this->addForeignKey("catalogue_property_category", "{{catalogue_property_to_category}}", "category_id", "{{catalogue_category}}", "id", "CASCADE", "CASCADE");
	}

	public function down()
	{
		echo "m120823_110631_properties does not support migration down.\n";
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