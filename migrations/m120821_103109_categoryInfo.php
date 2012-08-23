<?php

class m120821_103109_categoryInfo extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('{{catalogue_category_info}}', array(
            'id' => 'pk',
            'category_id' => 'int',
            'description' => 'text DEFAULT NULL',
        ));
        $this->createIndex('catalogue_category_unique', '{{catalogue_category_info}}', 'category_id', true);
        $this->addForeignKey("catalogue_category_info_categ", "{{catalogue_category_info}}", "category_id", "{{catalogue_category}}", "id", "CASCADE", "CASCADE");
    }

    public function safeDown()
    {
        $this->dropTable('{{catalogue_category_info}}');
        return false;
    }
}