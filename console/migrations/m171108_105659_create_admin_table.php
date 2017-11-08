<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171108_105659_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin',[
            'id' => $this->integer()->primaryKey(),
            'username' => $this->string()->notNull()->comment('用户名'),
           'password' => $this->string()->notNull()->comment('密码'),
            'salt' => $this->string()->notNull()->comment('盐'),





            ]);

    }

}
