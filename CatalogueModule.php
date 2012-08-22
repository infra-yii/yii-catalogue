<?php
class CatalogueModule extends CWebModule{

    public $infoFormView = "_infoForm";
    public $viewProduct = 'view';
    public $actionProductView = "/catalogue/product/view";

    public $categoryModelClass = "CatalogueCategory";
    public $productModelClass = "CatalogueProduct";
    public $productInfoModelClass = "CatalogueProductInfo";
    /**
     * Returns model class object
     * @return StaticPage
     */
    public function model()
    {
        return Category::model($this->categoryModelClass);
    }


}