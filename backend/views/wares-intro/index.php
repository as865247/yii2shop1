<?php
/* @var $this yii\web\View */
?>
<a href="<?php echo \yii\helpers\Url::to(['wares/index'])?>" class="btn btn-primary btn-lg active" role="button">返回</a>


<table class="table table-striped">



    <?php foreach ($model as $model):?>
        <tr><th>名称</th></tr>
        <tr><td><?php echo $model->name?></td></tr>
        <tr><th>介绍</th></tr>
        <tr><td><?php echo $model->content ?></td></tr>
        <tr><th>商品图片</th></tr>
        <td><?=\yii\bootstrap\Html::img($model->logo_one,['height'=>100]) ?>
            <?=\yii\bootstrap\Html::img($model->logo_two,['height'=>100]) ?>
            <?=\yii\bootstrap\Html::img($model->logo_three,['height'=>100]) ?></td>
    <?php endforeach ;?>
</table>

