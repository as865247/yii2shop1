<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/11/7
 * Time: 14:32
 */
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($wares,'name');
//echo $form->field($wares,'imgFile')->fileInput();
// ActiveForm
echo $form->field($wares, 'logo')->widget('manks\FileInput', [
]);
echo $form->field($wares,'goods_id')->dropDownList(\yii\helpers\ArrayHelper::map($good,'id', 'name'), ['class' => 'dropdownlist']);
echo $form->field($wares,'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map($brand,'id','name'),['class'=>'dropdownlist']);
echo $form->field($wares,'market_price');
echo $form->field($wares,'shop_price');
echo $form->field($wares,'stock');
echo $form->field($wares,'is_on_sale')->inline()->radioList(\backend\models\Wares::$statusSale);
echo $form->field($wares,'status')->inline()->radioList(\backend\models\Wares::$statusText);
echo $form->field($wares,'sort');
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();