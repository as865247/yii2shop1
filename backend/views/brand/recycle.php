<?php?>
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
        <td><?=\yii\bootstrap\Html::img('@web/'.$brand->logo,['height'=>40])?></td>
        <td><?=$brand->sort?></td>
        <td><?=$brand->status?></td>
        <td> <?php
            echo   \yii\bootstrap\Html::a("恢复",['brand/','id'=>$brand->id],['class'=>'btn btn-info']);


            ?>
        </td>
    </tr>


<?php endforeach;   ?>

</table>