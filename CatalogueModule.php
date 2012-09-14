<?php
class CatalogueModule extends CWebModule
{

    //category config init
    public $categoryModelClass = "CatalogueCategory";
    public $viewCategory = 'view';
    public $categoryInfoModelClass = "CatalogueCategoryInfo";
    public $actionCategoryView = "/catalogue/category/view";
    public $actionCategoryList = "/catalogue/category/list";
    public $categoryPropertiesModelClass = "CatalogueProperty";
    public $viewListCategory = "list";
    public $categoryIndexView = 'index';

    public $categoryCompareView = "compare";

    //product config init
    public $viewProduct = 'view';
    public $actionProductView = "/catalogue/product/view";
    public $productModelClass = "CatalogueProduct";
    public $productInfoModelClass = "CatalogueProductInfo";

    public $searchWidgetView = "search";
    public $searchResultView = "found";
    /**
     * @return array AdminGenModule integration
     */
    public function adminGenLinks()
    {
        $menuItems = array('label' => Yii::t("app", 'Catalogue'), 'url' => '', 'items' => array(
            array('url' => array("/catalogue/category/admin"), 'label' => Yii::t("app", "Manage Categories"), 'visible' => !Yii::app()->user->isGuest),
            array('url' => array("/catalogue/product/admin"), 'label' => Yii::t("app", "Manage Product"), 'visible' => !Yii::app()->user->isGuest)
        ),
        'visible' => !Yii::app()->user->isGuest);
        return $menuItems;
    }

    public function siteMapLinks()
    {
        $categories = array();

        $criteria = new CDbCriteria;
        $criteria->condition = 'parent_id is NULL';
        $criteria->order = 'sorting DESC';

        $arrayModels = Category::model()->findAll($criteria);

        foreach($arrayModels as $category){
            $categories[] = array('label' => $category->title, 'url' => $category->url());
        }

        $menuItems = array('label' => 'Каталог', 'url' => array('/catalogue/category/index'), 'items'=>$categories);
        return $menuItems;
    }

}