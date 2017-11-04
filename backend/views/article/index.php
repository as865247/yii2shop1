<?php
/* @var $this yii\web\View */
?>
<?=\yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-success'])?>&nbsp;
<?=\yii\bootstrap\Html::a('添加文章分类',['category/index'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>简介</th>
        <th>排序</th>
        <th>状态</th>
        <th>文章分类</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($articles as $article):?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->intro?></td>
            <td><?=$article->sort?></td>
            <td><?=$article->status?></td>
            <td><?=$article->cate->name?></td>
            <td><?=date('Y-m-d H:i:s',$article->inputime)?></td>
            <td> <?php
                echo   \yii\bootstrap\Html::a("查看内容",['article/show','id'=>$article->id],['class'=>'btn btn-primary']);
                echo   \yii\bootstrap\Html::a("编辑",['article/edit','id'=>$article->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['article/del','id'=>$article->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;   ?>

</table>