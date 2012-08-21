<?php
class CatalogueModule extends CWebModule{

    public $categoryModelClass = "CatalogueCategory";

    public $infoformView = "_infoform";

    /**
     * Returns model class object
     * @return StaticPage
     */
    public function model()
    {
        return Category::model($this->categoryModelClass);
    }


}