<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m171105_062140_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull()->comment('树'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->notNull()->comment('右值'),
            'depth' => $this->integer()->notNull()->comment('深度'),
            'name' => $this->string()->notNull()->comment('分类名称'),
            'intro'=>$this->integer()->notNull()->comment('简介'),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment('父ID'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
