<?php

namespace backend\controllers;
use backend\models\GoodsIntro;
use backend\models\Wares;
use backend\models\WaresGallery;
use backend\models\WaresIntro;
use flyok666\qiniu\Qiniu;
use kucha\ueditor\UEditorAction;
use yii\web\Controller;

class WaresIntroController extends Controller
{
    //Uedit方法体
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    //显示视图
    public function actionIndex($id)
    {
       $model=WaresIntro::find()->where(['wares_id'=>$id])->all();
        $wares = Wares::findOne($id);
        //var_dump($wares);exit;
        if ($model){
//            var_dump($model); exit();
            return $this->render('index',['model'=>$model,'wares'=>$wares]);
        }else{
            \Yii::$app->session->setFlash('success', '你还没有添加详情，请先添加');

            return $this->redirect(['wares/index']);
        }

    }
    //添加
    public function actionAppend($id)
    {
        $model =new WaresIntro();
        $wares= Wares::findOne($id);
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //1. 绑定数据
            if ($model->load($request->post())) {
                $model->name=$wares->name;
                $model->wares_id=$wares->id;
               if($model->validate()) {
                   if($model->save()){
                       \Yii::$app->session->setFlash('success', '添加成功');
                       return $this->redirect(['wares/index']);
                   }else{
                        $model->getErrors();exit();
                   }


               }else {
                   var_dump($model->getErrors());
                   exit();
               }
//                echo '<pre>';
//                var_dump($model->wares_id);exit;
//                var_dump($model->getErrors());exit();
                //6 保存数据



            }else {
                var_dump($model->getErrors());
                exit();
            }
        }

        return $this->render('append', ['model' => $model,'wares'=>$wares]);
    }

    //七牛云上传
    public
    function actionUploder()
    {
        $config = [
            'accessKey' => 'HURnNTvrk79TxHd_mgz7Iz3rIujgTjwSZCidY4w0',
            'secretKey' => 'UN6-QUKU2LSoT3aFVDGkNXwOszTy26BCxSaVs81A',
            'domain' => 'http://oyve5snrl.bkt.clouddn.com/ 

',
            'bucket' => 'yangke',
            'area' => Qiniu::AREA_HUANAN
        ];

        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES["file"]['tmp_name'], $key);
        $url = $qiniu->getLink($key);

        $info = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url
        ];
        echo json_encode($info);
    }


}
