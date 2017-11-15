<?php

namespace backend\controllers;

    use app\models\Brand;
    use yii\data\Pagination;
    use frontend\filters\TimeFilter;
    use yii\web\Controller;
    use yii\web\Request;
    use yii\web\UploadedFile;

class BrandController extends Controller
{
    public function actionIndex()
    {
        //1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 3;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['brands'=>$brands, 'page'=>$page] );
    }
    //添加
    public function  actionAdd(){
        $brand = new Brand();
        $request=new Request();
        if ($request->isPost) {

            //1.接收数据
            $data = $request->post();

            //2.处理数据
            if ($brand->load($data)) {
                $brand->imgFile = UploadedFile::getInstance($brand, 'imgFile');
                //再次验证
                if ($brand->validate()) {
//判断有没有文件上传
                    if ($brand->imgFile) {

                        // $good->imgFile->extension 文件的后缀
                        $filePath = "image/" . time() . "." . $brand->imgFile->extension;
                        //var_dump($filePath);exit;
                        //文件保存
                        $brand->imgFile->saveAs($filePath, false);
                        //保存数据
                        $brand->logo = $filePath;
                    }
                    $brand->save();
                    \Yii::$app->session->setFlash("success", "添加成功");
                    //跳转
                    $this->redirect(['brand/index']);

                }

            }
        }
        $brand->status=1;
        return $this->render('add',['brands'=>$brand]);
    }
//编辑
    public function  actionEdit($id){
        $brand=Brand::findOne($id);
        $request=new Request();
        if ($request->isPost) {

            //1.接收数据
            $data = $request->post();

            //2.处理数据
            if ($brand->load($data)) {
                $brand->imgFile = UploadedFile::getInstance($brand, 'imgFile');
                //再次验证
                if ($brand->validate()) {
//判断有没有文件上传
                    if ($brand->imgFile) {

                        // $good->imgFile->extension 文件的后缀
                        $filePath = "image/" . time() . "." . $brand->imgFile->extension;
                        //var_dump($filePath);exit;
                        //文件保存
                        $brand->imgFile->saveAs($filePath, false);
                        //保存数据
                        $brand->logo = $filePath;
                    }

                    $brand->save();
                    \Yii::$app->session->setFlash("success", "添加成功");
                    //跳转
                    $this->redirect(['brand/index']);

                }

            }
        }
        return $this->render('add',['brands'=>$brand]);
    }
//删除
public function  actionDel($id){
       $brand=Brand::findOne($id);
       $brand->status=0;
       $brand->save();
       $this->redirect(['brand/index']);
    }
public function actionRecycle(){
    $brand=Brand::find()->where(['status'=>0])->all();
    return $this->render('recycle',['brands'=>$brand]);
}

public function actionShow($id){
    $brand=Brand::findOne($id);
    //还原
    $brand->status=1;
    $brand->save();
    return $this->redirect(['brand/index']);

}
}
