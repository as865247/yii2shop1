<?php

namespace backend\controllers;

use app\models\Brand;
use app\models\WaresSearchForm;
use backend\models\Goods;
use backend\models\Wares;
use backend\models\WaresGallery;
use yii\data\Pagination;
use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;

class WaresController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $wares=Wares::find()->where(['status'=>1])->all();
        $query = Wares::find();
        $request=\Yii::$app->request;
        //接收变量
        $keyword=$request->get('keyword');
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $status=$request->get('status');
        if ($minPrice>0){
            //拼接条件
            $query->andWhere("shop_price >= {$minPrice}");
        }
        if ($maxPrice>0){
            $query->andWhere("shop_price <= {$maxPrice}");
        }
        if (isset($keyword)){
            $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
        //
        if ($status ==="1" or $status==="0"){
            $query->andWhere("status= {$status}");
        }

        $count=$query->count();
        $searchForm=new WaresSearchForm();
            $page = new Pagination(
            [
                'pageSize'=>5,
                'totalCount'=>$count
            ]
        );
        $models=$query->limit($page->limit)->offset($page->offset)->all();

        return $this->render('index',compact("page","","models","searchForm"));
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
    //删除
    public function  actionDel($id){
        $model=Wares::findOne($id);
        $model->status=0;
        $model->save();
        $this->redirect(['wares/index']);
    }
    public function actionRecycle()
    {
        $model = Wares::find()->where(['status' => 0])->all();
        return $this->render('recycle', ['wares' => $model]);
    }
    public function actionRecytion($id){
        $model=Wares::findOne($id);

        //还原
        $model->status=1;
        $model->save();
        return $this->redirect(['wares/index']);

    }
}
