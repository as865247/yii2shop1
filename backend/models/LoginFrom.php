<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2017/11/9
 * Time: 15:11
 */

namespace backend\models;


use yii\base\Model;

class LoginFrom extends Model
{
    public $username;
    public $password;
    //记住我,默认勾选
    public $rememberMe = true;
    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['rememberMe'],'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>"用户名",
            'password'=>'密码',
            'remembetMe'=>'是否保存账号密码'

        ];
    }
}