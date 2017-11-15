<?php
/* @var $this yii\web\View */

?>
<?=\yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-success'])?>

<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>简介</th>
        <th>LOGO</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=$brand->intro?></td>
            <td><?=\yii\bootstrap\Html::img('@web/'.$brand->logo,['height'=>40 ,'class'=>'img-circle'])?></td>
            <td><?=$brand->sort?></td>
            <td><?=\app\models\Brand::$statusText[$brand->status]?></td>
            <td> <?php
                echo   \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$brand->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['brand/del','id'=>$brand->id],['class'=>'btn btn-danger']);
                echo    \yii\bootstrap\Html::a('回收站',['brand/recycle'],['class'=>'btn btn-success']);
                ?>
            </td>
        </tr>


    <?php endforeach;   ?>

</table>
<?php

echo \yii\widgets\LinkPager::widget([

    'pagination' => $page
]);
?>