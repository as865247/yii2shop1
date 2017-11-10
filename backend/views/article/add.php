<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($articles,'name');
echo $form->field($articles,'intro');
echo $form->field($articles,'sort');
echo $form->field($articles,'article_categroy_id')->dropDownList($cates);
echo $form->field($articles,'content')->textInput();
echo $form->field($articles,'status')->inline()->radioList(['1'=>'显示','0'=>'隐藏']);

echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();