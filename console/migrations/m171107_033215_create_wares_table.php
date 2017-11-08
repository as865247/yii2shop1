<?php

use yii\db\Migration;

/**
 * Handles the creation of table `wares`.
 */
class m171107_033215_create_wares_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('wares', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'sn' => $this->char(15)->notNull()->comment('货号'),
            'logo' => $this->string(150)->notNull()->comment('商品logo'),
            'goods_id' => $this->integer()->notNull()->comment('商品分类'),
            'brand_id' => $this->integer()->notNull()->comment('品牌'),
            'market_price' => $this->decimal(10,2)->notNull()->comment('市场价格'),
            'shop_price' => $this->decimal(10,2)->notNull()->comment('本店价格'),
            'stock' => $this->integer()->notNull()->comment('库存'),
            'is_on_sale' => $this->smallInteger(4)->notNull()->comment('是否上架1是，0否'),
            'status' => $this->smallInteger(4)->notNull()->comment('1 正常 ，0回收站'),
            'sort' => $this->smallInteger(4)->notNull()->comment('排序'),
            'inputime' => $this->integer()->notNull()->comment('录入时间'),



        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('wares');
    }
}
