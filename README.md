1.项目介绍
===============================
### 1.1项目描述简介
类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。
为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
为了让大家掌握公司协同开发要点，我们使用git管理代码。
在项目中会使用很多前面的知识，比如架构、维护等等。
### 1.2主要功能模块
系统包括：
1. 后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
2. 前台：首页、商品展示、商品购买、订单管理、在线支付等。
### 1.3开发环境和技术
开发环境	Window
开发工具	Phpstorm+PHP5.6+GIT+Apache
相关技术	Yii2.0+CDN+jQuery+sphinx
### 1.4项目人员组成周期成本
### 1.4.1人员组成
职位	人数	备注
项目经理和组长	1	一般小公司由项目经理负责管理，中大型公司项目由项目经理或组长负责管理
开发人员	3	
UI设计人员	0	
前端开发人员	1	专业前端不是必须的，所以前端开发和UI设计人员可以同一个人
测试人员	1	有些公司并未有专门的测试人员，测试人员可能由开发人员完成测试。

公司有测试部，测试部负责所有项目的测试。

项目测试由产品经理进行业务测试。

项目中如果有测试，一般都具有Bug管理工具。（介绍某一个款，每个公司Bug管理工具不一样）
#### 1.4.2项目周期成本
人数	周期	备注
1	两周需求及设计	项目经理


1	两周
UI设计	UI/UE
4（1测试  2后端  1前端）	3个月
第1周需求设计
9周时间完成编码
2周时间进行测试和修复	

开发人员、测试人员


系统功能模块
-------------------
### 2.1需求
1. 品牌管理：
2. 商品分类管理：
3. 商品管理：
4. 账号管理：
5. 权限管理：
6. 菜单管理：
7. 订单管理：
### 2.2流程
1. 自动登录流程
2. 购物车流程
3. 订单流程
### 2.3设计要点（数据库和页面交互）
1. 系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
2. 商品无限级分类设计：
3. 购物车设计
### 2.4 要点难点及解决方案
回收站，找到stastus=0隐藏。
# 后台
## 1. 品牌管理
1. 品牌的添加管理
2. 品牌的编辑管理
3. 品牌的查看管理
4. 品牌的删除管理
### 品牌功能实现遇到的设计要点
1. 文件的上传，
```php
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
                        $brand->logo = $filePath;ss

```
2. 文件上传后的显示预览
### 品牌解决的功能
1. 采用七牛云技术做文件上传功能并且保存。
2. 文件预览回显采用jquery(status)技术实现。
## 2.文章分类管理系统
1. 文章的添加管理
2. 文章的编辑管理
3. 文章的查看管理
4. 文章的删除管理
### 文章管理系统遇到的设计要点
1. 查询的文章内容与文章的分类管理要相对应。
2. 文章数据库的设计。需要设计多张表，关联查询
### 文章解决功能
1. 文章采用多表查询的技术，实现文章内容与分类相对应的功能
```php
public function getCate(){
        return $this->hasOne(Category::className(),['id'=>'article_categroy_id']);
}
```
2. 文章功能的内容管理要和文章的标题相对应，最终实现文章显示的功能g.
## 3. 商品的分类管理
1. 商品分类的添加管理
2. 商品分类的编辑管理
3. 商品的删除管理
### 商品管理系统遇到的设计要点
1. 商品分类的无限级分类。
2. 商品分类的视图显示
3. 商品分类的编辑实现
### 商品分类解决方案
1. 商品无限级分类的实现方法需要用到嵌套集合技术
```php
//数据绑定
            $model->load($request->post());
            if ($model->validate()) {
                //判断父亲ID是不是0
                if ($model->parent_id == 0) {
                    //创建根目录
                    $model->makeRoot();
                    \Yii::$app->session->setFlash('success', '添加一级目录成功');
//                    return $this->render('add');
                } else {
                    //创建子分类

                    //1.把父节点找到
                    $cateParent = Goods::findOne(['id' => $model->parent_id]);
                    //2.把当前节点对添加到父类对象中
                    $model->prependTo($cateParent);

                }
                \Yii::$app->session->setFlash('success','添加目录成功');
//                return $this->render('add');

```
2. 实现功能用到插件以及Ztree技术来实现、
```php
'setting' => '{
            callback: {
		        onClick: function(event, treeId, treeNode){
		        console.dir(treeNode);
		        $("#goods-parent_id").val(treeNode.id);
		        }
	     },
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
			        pIdKey: "parent_id",
			        rootPId: 0
				}
			}
		}',
    'nodes' => $cates
```

3. 遇到的问题是视图的设计和商品分类的编辑功能
```php
public $template = '{:update} {:delete}';
    /**
     * 重写了标签渲染方法。
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return preg_replace_callback('/\\{([^}]+)\\}/', function ($matches) use ($model, $key, $index) {
            list($name, $type) = explode(':', $matches[1].':'); // 得到按钮名和类型
//            if($name == 'view'){
//                $url = Yii::$app->request->hostInfo.'/product/'.$model->id.'.html';
//                return call_user_func($this->buttons[$type], $url, $model, $key,$options=['target'=>'_blank']);
//
//            }else{
            if (!isset($this->buttons[$type])) { // 如果类型不存在 默认为view
                $type = 'index';
            }
            if ('' == $name) { // 名称为空，就用类型为名称
                $name = $type;
            }
            $url = $this->createUrl($name, $model, $key, $index);
            return call_user_func($this->buttons[$type], $url, $model, $key);
//            }
        }, $this->template);
    }
    /**
     * 方法重写，让view默认新页面打开
     * @return [type] [description]
     */
    protected function initDefaultButtons(){
//        if (!isset($this->buttons['view'])) {
//            $this->buttons['view'] = function ($url, $model, $key) {
//
//                $options = array_merge([
//                    'title' => Yii::t('yii', 'View'),
//                    'aria-label' => Yii::t('yii', 'View'),
//                    'data-pjax' => '0',
//                    'target'=>'_blank'
//                ], $this->buttonOptions);
//                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/goodscategory/view?id='.$model->id, $options);
//            };
//        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/goods-category/edit?id='.$model->id, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/goods-category/del?id='.$model->id, $options);
            };
        }
    }

```
4. 会遇到异常需要捕获。
5. 删除会遇到有子节点的类不能直接删除
```php
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
            return $this->redirect(['index']);s

```
### 商品管理
1. 商品的添加功能
2. 商品的编辑功能
3. 商品的删除
### 商品管理系统遇到的设计要点
1. 保存每天创建多少商品,创建商品的时候,更新当天创建商品数量
2. 商品增删改查
3. 商品列表页可以进行搜索(商品名,商品状态,售价范围)
4. 新增商品自动生成sn,规则为年月日+今天的第几个商品,比如201704010001 
5. 商品详情使用ueditor插件 
### 要点难点及解决方案
1. 商品分类只能选择第三级分类
2. 品牌使用下拉选择
3. 商品相册,添加完商品后,跳转到添加商品相册页面,允许多图片上传
4. 创建goods_day_count数据迁移时,如何创建date类型主键
5. 商品介绍使用UEditor(https://github.com/BigKuCha/yii2-ueditor-widget)
### 管理员模块
1. 管理员的添加
2. 管理员的编辑
3. 管理员的删除
### 管理员管理系统遇到的设计要点
1. 添加管理员
2. 管理员登录
3. 管理员注销
4. 自动登录
### 要点难点及解决方案
1. 创建admin表(在user表基础上添加最后登录时间和最后登录ip)
 

