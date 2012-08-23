<?php

class m120821_103109_categoryInfo extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{category_info}}', array(
            'id' => 'pk',
            'category_id' => 'int',
            'description' => 'text DEFAULT NULL',
            'UNIQUE KEY `product_id` (`product_id`)',
        ));
	}

	public function down()
	{
        $this->dropTable('{{category_info}}');
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