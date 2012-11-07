<?php

class m120918_082134_techProperties extends EDbMigration
{
	public function up()
	{
        $this->addColumn("{{catalogue_product_info}}", "teh_info", "tinytext");
	}

	public function down()
	{
		echo "m120918_082134_techProperties does not support migration down.\n";
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