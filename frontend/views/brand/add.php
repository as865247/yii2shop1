<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($brands,'name');
echo $form->field($brands,'intro');
echo $form->field($brands,'sort');
echo $form->field($brands,'status')->inline()->radioList(\app\models\Brand::$statusText);
echo $form->field($brands,'imgFile')->fileInput();
echo \yii\bootstrap\Html::img('@web/'.$brand->logo,['height'=>40]);

echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();