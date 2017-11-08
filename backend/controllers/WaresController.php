<?php

namespace backend\controllers;

use app\models\Brand;
use backend\models\Goods;
use backend\models\Wares;
use backend\models\WaresGallery;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;

class WaresController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $wares=Wares::find()->all();
        return $this->render('index',['wares' => $wares]);
    }
    //添加
 public  function actionAdd()
 {
     $model = new Wares();
     $good = Goods::find()->all();
     $brand= Brand::find()->all();
     $request = \Yii::$app->request;
     if ($request->isPost) {
         //绑定数据
         if ($model->load($request->post())) {



             if ($model->validate()) {

//                 var_dump($model->name);exit;
                 //追加时间
                 $model->inputime=time();
                 //判断文件上传的路径
                 $model->sn=date('Ymd').$model->inputime."0000".$model->id;
                 $model->save();
                 \Yii::$app->session->setFlash("success", "添加成功");
                 //跳转
                 return     $this->redirect(['wares/index']);


                 }else{

                var_dump( $model->getErrors());exit;
             }

             }
         }
    return  $this->render('add',['wares'=>$model,'good'=>$good,'brand'=>$brand]);
 }

 //编辑
    public  function actionEdit($id)
    {
        $model =Wares::findOne($id);
        $good = Goods::find()->all();
        $brand=Brand::find()->all();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            if ($model->load($request->post())) {
                if ($model->validate()) {

                    $model->save();
                    \Yii::$app->session->setFlash("success", "添加成功");
                    //跳转
                    $this->redirect(['wares/index']);

                    }else{

                    var_dump( $model->getErrors());exit;
                }

                }
            }
        return  $this->render('add', [ 'wares'=> $model,'good'=>$good,'brand'=>$brand]);
    }
    public function actionDel($id){

        $model=Wares::findOne($id);
        //删除
        $model->delete();
        //跳转
        $this->redirect(['model/index']);
    }
    //相册
    public function actionGallery(){
        $gallery=WaresGallery::find()->all();
      return  $this->render('index', ['gallery' =>$gallery ]);
    }
//七牛云上传
    public function actionUpload(){


        $config = [
            'accessKey'=>'XT8cwcHmYBSe6mksIrFkNaZy0J7lMDUhiVydwQQt',
            'secretKey'=>'1A3xLkcuGHnQc8M1tObWn_ATay4sCr8oEiYDUAQm',
            'domain'=>'http://oz1j5x86h.bkt.clouddn.com',
            'bucket'=>'php0712',
            'area'=>Qiniu::AREA_HUADONG
        ];


//            var_dump($_FILES);die();
        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);

        $info=[
                'code'=>0,
                'url'=>$url,
                'attachment'=>$url

        ];
       echo json_encode($info);

    }
}
