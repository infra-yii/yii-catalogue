<?php

class m120822_122547_categoryPath extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{catalogue_category}}', 'path', 'varchar(200) DEFAULT NULL');
        $this->createIndex("catalogue_category_path", "{{catalogue_category}}", "path", true);
    }

    public function safeDown()
    {
        echo "m120822_122547_categoryPath does not support migration down.\n";
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