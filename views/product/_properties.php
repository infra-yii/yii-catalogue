<?php
/* @var $model CatalogueProduct */
/* @var $props CatalogueProperty[] */
/* @var $vals CataloguePropertyValue[] */
$props = array();
foreach($model->categories as $c) {
    foreach($c->collectProperties() as $p) {
        $props[$p->id] = $p;
    }
}
$vals = array();
foreach($model->propertiesValues as $v) {
    $vals[$v->property_id] = $v;
}

?>


        <?foreach($props as $id=>$prop) {?>
    <div class="row">
        <?=CHtml::label($prop->title, "propValue[$id]")?>
        <?=CHtml::textField("propValue[$id]", isset($vals[$id]) ? $vals[$id]->value : "")?>
    </div>
<?}?>