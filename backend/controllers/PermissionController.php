<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //实例化RBAC组件
        $authManager=\Yii::$app->authManager;
        //显示权限 把所有的权限查出来
        $permissios=$authManager->getPermissions();
        return $this->render('index',compact('permissios'));
    }
    public function  actionAdd(){
        $model= new AuthItem();
        $request=\Yii::$app->request;
        if($model->load($request->post())&& $model->validate()){
         //实例化RBAC组件
          $authManager=\Yii::$app->authManager;
          //创建权限
            $permission=$authManager->createPermission($model->name);
            //添加描述
            $permission->description=$model->description;
            //添加权限
            $authManager->add($permission);
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->redirect(['index']);
        }
        return $this->render('add',compact('model'));
    }
    //编辑

        public function  actionEdit($name){
        $model= AuthItem::findOne($name);
        $request=\Yii::$app->request;
        if($model->load($request->post())&& $model->validate()){
            //实例化RBAC组件
            $authManager=\Yii::$app->authManager;
            //创建权限
            $permission=$authManager->getPermission($model->name);

            if($permission){
                //添加描述
                $permission->description=$model->description;
                //修改权限
                $authManager->update($model->name,$permission);
                \Yii::$app->session->setFlash("success","修改".$model->description."成功");
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash("danger","不能修改权限名称".$model->name);
                return $this->refresh();
            }

        }
        return $this->render('add',compact('model'));
    }
    public function actionDel($name){
            $auth=\Yii::$app->authManager;
            //找到要删除的权限的对象
        $permission=$auth->getPermission($name);
        //删除权限
        if($auth->remove($permission)){
            \Yii::$app->session->setFlash("success","删除".$name."成功");
            return $this->redirect(['index']);
        }
    }
}
