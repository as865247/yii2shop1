<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($categorys,'name');
echo $form->field($categorys,'intro');
echo $form->field($categorys,'sort');
echo $form->field($categorys,'status')->inline()->radioList(\app\models\Brand::$statusText);
echo $form->field($categorys,'type_help');

echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();