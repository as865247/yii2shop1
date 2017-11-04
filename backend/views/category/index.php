<?php
/* @var $this yii\web\View */
?>
<?=\yii\bootstrap\Html::a('返回',['article/index'],['class'=>'btn btn-success'])?>&nbsp;
<?=\yii\bootstrap\Html::a('添加文章',['category/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>是否帮助分类</th>
        <th>操作</th>
    </tr>
    <?php foreach ($categorys as $category):?>
        <tr>
            <td><?=$category->id?></td>
            <td><?=$category->name?></td>
            <td><?=$category->intro?></td>
            <td><?=$category->sort?></td>
            <td><?=$category->status?></td>
            <td><?=$category->type_help?></td>
            <td> <?php
                echo   \yii\bootstrap\Html::a("编辑",['category/edit','id'=>$category->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['category/del','id'=>$category->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;   ?>

</table>
