<?php

use yii\db\Migration;

/**
 * Class m230404_061225_attendance
 */
class m230404_061225_attendance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230404_061225_attendance cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'dbType' => $this->smallInteger(1)->defaultValue(1)->comment('1=mysql,2=mssql,3=oracle'),
            'type' => $this->smallInteger(1)->defaultValue(1)->comment('1=Target, 2=Destination'),
            'host' => $this->string(100)->notNull(),
            'dbname' => $this->string(100)->null(),
            'username' => $this->string(50)->notNull(),
            'password' => $this->string(100)->notNull(),
            'charset' => $this->string(100)->defaultValue('utf8')->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Inactive, 1=Active'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);
    }

    public function down()
    {

        echo "m230404_061225_attendance cannot be reverted.\n";
        $this->dropTable('company');
        return false;
    }

}
