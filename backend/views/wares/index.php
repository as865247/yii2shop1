<?php
/* @var $this yii\web\View */
?>&nbsp;
<?=\yii\bootstrap\Html::a('添加商品',['wares/add'],['class'=>'btn btn-success'])?>&nbsp;
<?=\yii\bootstrap\Html::a('回收站',['wares/recycle'],['class'=>'btn btn-success'])?>

<div class="row">
    <div class="col-md-10">

          <form class="form-inline pull-right">
            <input type="text" class="form-control" id="minPrice" name="minPrice" size="8" placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>"> -
            <input type="text" class="form-control" id="maxPrice" name="maxPrice"  size="8" placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="请输入商品名称或货号" value="<?=Yii::$app->request->get('keyword')?>">
            <button type="submit" class="btn btn-default">搜索</button>
        </form>

    </div>


<table class="table">
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品logo</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架1是0否</th>
        <th>状态1正常0回收站</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sn?></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>40 ,'class'=>'img-circle'])?></td>
            <td><?=$model->goods->name?></td>
            <td><?=$model->brand->name?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->stock?></td>
            <td><?=\backend\models\Wares::$statusText[$model->is_on_sale]?></td>
            <td><?=\backend\models\Wares::$statusSale[$model->status]?></td>
            <td><?=$model->sort?></td>
            <td><?=date('Y-m-d H:i:s',$model->inputime) ?></td>
            <td> <?php
                echo   \yii\bootstrap\Html::a("编辑",['wares/edit','id'=>$model->id],['class'=>'btn btn-success']);
                echo   \yii\bootstrap\Html::a("查看详情",['wares-intro/index','id'=>$model->id],['class'=>'btn btn-primary']);
                echo   \yii\bootstrap\Html::a("添加详情",['wares-intro/append','id'=>$model->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['wares/del','id'=>$model->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;   ?>

</table>