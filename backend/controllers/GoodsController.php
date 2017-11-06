<?php

namespace backend\controllers;

use app\models\GoodsDel;
use backend\models\Goods;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\controller;

class GoodsController extends controller
{
    //查看
    public function actionIndex()
    {

        $cates=Goods::find();
        $dataProvider=new ActiveDataProvider([
            'query' => $cates,
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
    /*
     *添加商品分类
     */
    public function  actionAdd(){
        $model=new Goods();
        //判断是不是post提交
        $request=\Yii::$app->request;
        if($request->isPost) {
            //数据绑定
            $model->load($request->post());
            if ($model->validate()) {
                //判断父亲ID是不是0
                if ($model->parent_id == 0) {
                    //创建根目录
                    $model->makeRoot();
                    \Yii::$app->session->setFlash('success', '添加一级目录成功');
//
                } else {
                    //创建子分类

                    //1.把父节点找到
                    $cateParent = Goods::findOne(['id' => $model->parent_id]);
                    //2.把当前节点对添加到父类对象中
                    $model->prependTo($cateParent);
                    \Yii::$app->session->setFlash('success', '添加目录成功');
                    return $this->redirect(['index']);
                }

            }
            }

                //得到所有的分类
                $cates=Goods::find()->asArray()->all();
                $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
                $cates=Json::encode($cates);
        //跳转
        return $this->render("add",['model'=>$model,'cates'=>$cates]);

    }
        /*
        *修改商品分类
        */
    public function  actionEdit($id){
        $model=Goods::findOne($id);
        //判断是不是post提交
        $request=\Yii::$app->request;
        if($request->isPost) {
            //数据绑定
            $model->load($request->post());
            if ($model->validate()) {
                //判断父亲ID是不是0
                if ($model->parent_id == 0) {
                    //创建根目录
                   $model->makeRoot();

                    \Yii::$app->session->setFlash('success', '添加一级目录成功');
//
                } else {
                    //1.把父节点找到
                    $cateParent = Goods::findOne(['id' => $model->parent_id]);
                    //2.把当前节点对添加到父类对象中
                    $model->prependTo($cateParent);
                    \Yii::$app->session->setFlash('success','添加目录成功');
                    return $this->redirect(['index']);
                }
            }
        }
        //得到所有的分类
        $cates=Goods::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);
        //跳转
        return $this->render("add",['model'=>$model,'cates'=>$cates]);

    }
    //删除
    public function  actionDel($id){
        //找到对象
       $cate = Goods::findOne(['parent_id'=>$id]);
        //删除
        if($cate!=null) {
            \Yii::$app->session->setFlash('success', "文件内含文件，不能删除！请先删除子文件");
            return $this->redirect(['index']);
        }else{
            $cate=Goods::findOne($id);
            if($cate->depth==0){
                GoodsDel::findOne($id)->delete();
            }else{
                Goods::findOne($id)->delete();
            }
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }
}
