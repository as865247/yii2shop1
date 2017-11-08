<?php $form=\yii\bootstrap\ActiveForm::begin()?>
<?=$form->field($wares,'id')->textInput() ?>
<?=$form->field($wares,'name')->textInput() ?>
<?=$form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);?>
<?=\yii\bootstrap\Html::img('@web/'.$model->logo_one,['height'=>50]) ?>
<?=\yii\bootstrap\Html::img('@web/'.$model->logo_two,['height'=>50]) ?>
<?=\yii\bootstrap\Html::img('@web/'.$model->logo_three,['height'=>50]) ?>

<?php
// ActiveForm
echo $form->field($model, 'logo_one')->widget('manks\FileInput', []);
echo $form->field($model, 'logo_two')->widget('manks\FileInput', []);
echo $form->field($model, 'logo_three')->widget('manks\FileInput', []);
?>



<?=\yii\helpers\Html::submitButton('提交',['class'=>'btn btn-success'])?>



<?php $form=\yii\bootstrap\ActiveForm::end()?>
