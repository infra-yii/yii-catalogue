<?php
class CatalogueModule extends CWebModule
{

    //category config init
    public $categoryModelClass = "CatalogueCategory";
    public $viewCategory = 'view';
    public $categoryInfoModelClass = "CatalogueCategoryInfo";
    public $actionCategoryView = "/catalogue/product/view";
    public $categoryInfoFormView = "_infoForm";
    public $categoryPropertiesModelClass = "CatalogueProperty";

    //product config init
    public $infoFormView = "_infoForm";
    public $viewProduct = 'view';
    public $actionProductView = "/catalogue/product/view";
    public $productModelClass = "CatalogueProduct";
    public $productInfoModelClass = "CatalogueProductInfo";

    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        $menuItems = array('label' => 'Catalogue', 'url' => '', 'items' => array(
            array('url' => array("/catalogue/category/admin"), 'label' => Yii::t("app", "Manage Categories"), 'visible' => !Yii::app()->user->isGuest),
            array('url' => array("/catalogue/product/admin"), 'label' => Yii::t("app", "Manage Product"), 'visible' => !Yii::app()->user->isGuest)
        ),
        'visible' => !Yii::app()->user->isGuest);
        return $menuItems;
    }

}