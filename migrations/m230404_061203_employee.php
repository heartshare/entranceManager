<?php

use yii\db\Migration;

/**
 * Class m230404_061203_employee
 */
class m230404_061203_employee extends Migration
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
        echo "m230404_061203_employee cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'uuid' => $this->char(36),
            'userId' => $this->integer(),
            'role' => $this->smallInteger(),
            'name' => $this->string(50),
            'password' => $this->string(50),
            'cardNo' => $this->string(20),
            'finger' => $this->string(4000),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Sync 1=FingerSync 2=Completed'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

        $this->createIndex('uniqueUid', 'employee', 'uuid', true );
        $this->createIndex('userIdIndex', 'employee', 'userId' );
    }

    public function down()
    {

        echo "m230404_061203_employee cannot be reverted.\n";
        $this->dropTable('employee');
        return false;
    }

}
