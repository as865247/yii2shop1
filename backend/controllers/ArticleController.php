<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\Request;
class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $articles=new Article();
        $article=$articles->find()->all();


        //显示视图
        return $this->render("index",['articles'=>$article]);
    }
    //添加
    public function actionAdd()
    {
        $article = new Article();
        $request = new Request();
        $category=Category::find()->all();
        $cates=ArrayHelper::map($category,'id','name');

        if ($request->isPost) {
            //1.接收数据
            $data = $request->post();

            //2.处理数据
            if ($article->load($data)) {
                //再次验证
                if ($article->validate()) {
                    $article->save();
                    //跳转
                    $this->redirect(['article/index']);

                }
            }
        }
        $article->status=1;
        return $this->render('add',['articles'=>$article ,'cates'=>$cates]);
    }


    //编辑
    public function actionEdit($id)
    {
        $article=Article::findOne($id);
        //创建Request对象
        $request = new Request();
        $category=Category::find()->all();
        $cates=ArrayHelper::map($category,'id','name');
        if ($request->isPost) {
            //1.接收数据
            $data = $request->post();
            //2.处理数据
            if ($article->load($data)) {
                //再次验证
                if ($article->validate()) {
                    //追加时间
                    $article->inputime=time();
                    $article->save();
                    //跳转
                    $this->redirect(['article/index']);

                }
            }
        }
        return $this->render('add',['articles'=>$article,'cates'=>$cates]);
    }
    //删除
    public function  actionDel($id){
        //找到对象
        $article=Article::findOne($id);
        //删除
        $article->delete();
        //跳转
        $this->redirect(['article/index']);
    }
    //查看
    public function actionShow($id){

        $model=Article::findOne($id);
        return $this->render('show',['model'=>$model]);
    }
}
