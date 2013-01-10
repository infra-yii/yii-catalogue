<?php

class SearchController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
                'users' => array('*'),
            ),
        );
    }

    /*
     *
     */
    public function actionIndex()
    {
        $search = new CatalogueSearch;

        if(isset($_GET['CatalogueSearch'])) {
            $search->attributes = $_GET['CatalogueSearch'];
            $_GET['searchString'] = $search->string;
        }

        $criteria = new CDbCriteria(array(
            'condition' => 'title LIKE :keyword',
            'params' => array(
                ':keyword' => '%'.$search->string.'%',
            ),
        ));

        $criteriaProducts = new CDbCriteria(array(
            'condition' => 'title LIKE :keyword OR article LIKE :keyword ',
            'params' => array(
                ':keyword' => '%'.$search->string.'%',
            ),
        ));

        $categoryModelClass = $this->getCatalogueModule()->categoryModelClass;
        $productModelClass =  $this->getCatalogueModule()->productModelClass;

        $categoryModel = new $categoryModelClass;
        $productModel =  new $productModelClass;

        $categoryCount = $categoryModel->count($criteria);
        $productCount = $productModel->count($criteriaProducts);

        $pages = new CPagination($categoryCount + $productCount);
        $pages->pageSize = '10';
        $pages->applyLimit($criteria);

        $categories = $categoryModel->findAll($criteria);
        $products = $productModel->findAll($criteriaProducts);

        $this->render(Yii::app()->getModule("catalogue")->searchResultView,array(
            'categories' => $categories,
            'products' => $products,
            'pages' => $pages,
            'search' => $search,
        ));

        return true;
    }

    /**
     * @return CatalogueModule
     */
    private function getCatalogueModule()
    {
        return Yii::app()->getModule("catalogue");
    }
}
