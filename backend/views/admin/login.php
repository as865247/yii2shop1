<div><div class="col-xs-6 col-md-5"> </div></div>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = '请游客登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-login col-xs-6 col-md-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>亲爱的玩家,欢迎你:请你登陆你的账号和密码</p>

    <div class="row">
        <div class="col-lg-5" >
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
