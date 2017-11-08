<?php
/* @var $this yii\web\View */
?>&nbsp;
<?=\yii\bootstrap\Html::a('添加商品',['wares/add'],['class'=>'btn btn-success'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品logo</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架1是0否</th>
        <th>状态1正常0回收站</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($wares as $ware):?>
        <tr>
            <td><?=$ware->id?></td>
            <td><?=$ware->name?></td>
            <td><?=$ware->sn?></td>
            <td><?=\yii\bootstrap\Html::img($ware->logo,['height'=>40 ,'class'=>'img-circle'])?></td>
            <td><?=$ware->goods_id?></td>
            <td><?=$ware->brand_id?></td>
            <td><?=$ware->market_price?></td>
            <td><?=$ware->shop_price?></td>
            <td><?=$ware->stock?></td>
            <td><?=$ware->is_on_sale?></td>
            <td><?=$ware->status?></td>
            <td><?=$ware->sort?></td>
            <td><?=date('Y-m-d H:i:s',$ware->inputime) ?></td>
            <td> <?php
                echo   \yii\bootstrap\Html::a("编辑",['wares/edit','id'=>$ware->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['wares/del','id'=>$ware->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;   ?>

</table>