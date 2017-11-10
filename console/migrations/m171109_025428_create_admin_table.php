<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171109_025428_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('管理员'),
            'auth_key' => $this->string(32)->notNull()->comment('自动登陆令牌'),
            'password' => $this->string()->notNull()->comment('密码'),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'add_time'=>$this->integer()->notNull()->comment('注册时间'),
            'last_login_time'=>$this->integer()->notNull()->comment('最后登陆时间'),

            'last_login_ip'=>$this->string()->notNull()->comment('登陆ip')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
