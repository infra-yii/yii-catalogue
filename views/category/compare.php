<?php
/**
 * @author alari
 * @since 8/28/12 11:58 AM
 *
 * @var $model CatalogueCategory
 */

$products = $model->products;
$props = $model->collectProperties();

$values = array();
foreach ($products as $p) {
    if (!isset($values[$p->base_category_id])) {
        $values[$p->base_category_id] = array();
    }
    $arr = array("product" => $p);
    foreach ($p->propertiesValues as $v) {
        $arr[$v->property_id] = $v->value;
    }
    $values[$p->base_category_id][] = $arr;
}

foreach ($subCategories as $modelSubCategory) {
    foreach ($modelSubCategory->products as $p) {
        if (!isset($values[$p->base_category_id])) {
            $values[$p->base_category_id] = array();
        }
        $arr = array("product" => $p);
        foreach ($p->propertiesValues as $v) {
            $arr[$v->property_id] = $v->value;
        }
        $values[$p->base_category_id][] = $arr;
    }
}

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/files/js/jquery-latest.js');
$cs->registerScriptFile('/files/js/jquery.tablesorter.js');
$js = <<<EOP
$(document).ready(function()
    {
        $('table').tablesorter().bind("sortEnd", function(){
                $('.tablesorter_rowspan').attr('rowspan','1');
                $('.tablesorter_td_hidden').removeClass('tablesorter_td_hidden');

            });
    }
);
EOP;
// Register js code
$cs->registerScript('Yii.' . get_class($this) . 'compare', $js, CClientScript::POS_READY);
?>
<style type="text/css">
    .tablesorter_td_hidden{ display: none }
</style>
<h1><?=$model->title?></h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
        <?foreach($props as $pr){?>
            <th><?=$pr->title?></th>
        <?}?>
        </tr>
    </thead>
    <tbody>
    <?foreach ($values as $baseId => $products) { ?>

    <? $i=0; ?>
    <? foreach ($products as $p) { ?>
    <? $i++; ?>
        <tr>
            <th><?=CHtml::link($p["product"]->title, $p["product"]->url())?></th>
            <?foreach($props as $pr) {?>
                <td><?=(isset($p[$pr->id]) ? $p[$pr->id] : "-")?></td>
            <?}?>
            <td <? if ($i==1) echo 'class="tablesorter_rowspan" rowspan='.count($products); else echo 'class="tablesorter_td_hidden"' ?> ><?=$products[0]["product"]->baseCategory->title?></td>
        </tr>
    <? } ?>

    <? }?>
    </tbody>
</table>