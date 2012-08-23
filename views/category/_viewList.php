<?php
/* @var $this CategoryController */
/* @var $model Category */
?>

<div class="view">

    <?php if(isset($data->picHolder)) $this->widget("imagesHolder.widgets.heldImages.HeldImages", array("holder" => $data->picHolder, "size" => "tiny")) ?>
    <?php echo CHtml::link(CHtml::encode($data->title), array('list', 'id'=>$data->id)); ?>
    <br />

</div>