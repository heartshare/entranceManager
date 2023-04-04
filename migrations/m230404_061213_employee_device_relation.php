<?php

use yii\db\Migration;

/**
 * Class m230404_061213_employee_device_relation
 */
class m230404_061213_employee_device_relation extends Migration
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
        echo "m230404_061213_employee_device_relation cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('employee_device_relation', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(36),
            'deviceUid' => $this->integer(100),
            'employeeId' => $this->integer(100),
            'deviceId' => $this->integer(),
            'finger' => $this->smallInteger(1),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Inactive, 1=Active'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

        $this->createIndex('uniqueUid', 'employee_device_relation', 'uuid', true );
        $this->createIndex('compositeEmployeeId', 'employee_device_relation', ['employeeId', 'deviceId'], true);
    }

    public function down()
    {

        echo "m230404_061213_employee_device_relation cannot be reverted.\n";
        $this->dropTable('employee_device_relation');
        return false;
    }

}
