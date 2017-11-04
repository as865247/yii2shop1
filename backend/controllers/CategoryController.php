<?php

namespace backend\controllers;

use backend\models\Category;
use yii\web\Request;
class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $categorys=new Category();
        $category=$categorys->find()->all();


        //显示视图
        return $this->render("index",['categorys'=>$category]);
    }
    //添加
    public function actionAdd()
    {
        $category = new Category();
        $request = new Request();
        if ($request->isPost) {
            //1.接收数据
            $data = $request->post();

            //2.处理数据
            if ($category->load($data)) {
                //再次验证
                if ($category->validate()) {
                    $category->save();
                    //跳转
                    $this->redirect(['category/index']);

                }
            }
        }
        return $this->render("add",['categorys'=>$category]);
    }
    //编辑
    public function actionEdit($id)
    {
        $category=Category::findOne($id);
        //创建Request对象
        $request = new Request();
        if ($request->isPost) {
            //1.接收数据
            $data = $request->post();
            //2.处理数据
            if ($category->load($data)) {
                //再次验证
                if ($category->validate()) {
                    //追加时间
                    $category->inputime=time();
                    $category->save();
                    //跳转
                    $this->redirect(['category/index']);

                }
            }
        }
        return $this->render("add",['categorys'=>$category]);
    }
    //删除
    public function  actionDel($id){
        //找到对象
        $category=Category::findOne($id);
        //删除
        $category->delete();
        //跳转
        $this->redirect(['category/index']);
    }
}
