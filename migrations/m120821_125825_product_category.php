<?php

class m120821_125825_product_category extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{product}}", "base_category_id", "int");
        $this->addForeignKey("base_category_id", "{{product}}", "base_category_id", "{{category}}", "id",null,"CASCADE");
	}

	public function down()
	{
		echo "m120821_125825_product_category does not support migration down.\n";
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