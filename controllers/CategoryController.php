<?php

class CategoryController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

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
                'actions' => array('index', 'view', 'tree', 'list', 'compare', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $c = $this->getModelClass();
        $model = new $c;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[$this->getModelClass()])) {
            $infoClass = $this->getCatalogueModule()->categoryInfoModelClass;

            $model->attributes = $_POST[$this->getModelClass()];

            $model->info = new $infoClass;
            $model->info->attributes = $_POST[$this->getModelClass()]['info'];
            $model->info->save();

            if ($model->save()) {
                $model->properties = $this->getNewProps();
                $model->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id)->with('info');
        if (isset($_POST[$this->getModelClass()])) {
            $model->info->attributes = $_POST[$this->getModelClass()]['info'];

            $model->attributes = $_POST[$this->getModelClass()];
            if ($model->save()) {
                $model->info->save();

                $this->setActualProps($model);
                $model->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    private function setActualProps(CatalogueCategory &$model) {
        $properties = isset($_POST['properties']) ? $_POST['properties'] : array();
        $props = $this->getNewProps();

        foreach($properties as $id=>$v) {
            if(isset($v["delete"])) continue;
            foreach($model->properties as $p) {
                if($p->id == $id) {
                    if($p->title != $v["title"]) {
                        $p->title = $v["title"];
                        $p->save();
                    }
                    $props[] = $p;
                }
            }
        }
        $model->properties = $props;
    }

    private function getNewProps() {
        $newProperties = isset($_POST['newProperties']) ? $_POST['newProperties'] : array();
        $propertiesClass = $this->getCatalogueModule()->categoryPropertiesModelClass;

        $props = array();
        foreach($newProperties as $title) {
            $p = CatalogueProperty::model()->findByAttributes(array("title"=>$title));
            if(!$p) {
                $p = new $propertiesClass();
                $p->title = $title;
                $p->save();
            }
            $props[] = $p;
        }
        return $props;
    }

    public function actionCompare($id) {
        $model = $this->loadModel($id)->with("properties");
        $subCategories = Category::model()->subCategories($model);

        $this->render($this->getCatalogueModule()->categoryCompareView, array("model"=>$model,'subCategories'=>$subCategories));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists Root category.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider($this->getCatalogueModule()->categoryModelClass, array(
            'criteria' => array(
                'condition' => 'parent_id is NULL',
                'order' => 'sorting DESC',
                'with' => array('picHolder'),
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {   $c = $this->getModelClass();
        $model = new $c('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET[$this->getModelClass()]))
            $model->attributes = $_GET[$this->getModelClass()];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all category by parent id
     * @param integer $id the ID of the parent id
     */
    public function actionList($id)
    {
        $model = $this->loadModel($id);

        $categoryProvider = new CActiveDataProvider($this->getCatalogueModule()->categoryModelClass, array(
            'criteria' => array(
                'condition' => 'parent_id=' . $id,
                'order' => 'sorting DESC',
                'with' => array('picHolder'),
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        $productProvider = new CActiveDataProvider($this->getCatalogueModule()->productModelClass, array(
            'criteria' => array(
                //'with'=>array('categories'),
                'join' => 'JOIN {{catalogue_category_to_product}} on t.id={{catalogue_category_to_product}}.product_id',
                'condition' => 'category_id=' . $id,
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));

        $this->render($this->getCatalogueModule()->viewListCategory, array(
            'model' => $model,
            'categoryProvider' => $categoryProvider,
            'productProvider' => $productProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        if (is_numeric($id)) {
            $model = CatalogueCategory::model()->findByPk($id);
        } else {
            $model = CatalogueCategory::model()->findByPath($id);
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * @return CatalogueModule
     */
    private function getCatalogueModule()
    {
        return Yii::app()->getModule("catalogue");
    }

    private function getModelClass()
    {
        return $this->getCatalogueModule()->categoryModelClass;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
