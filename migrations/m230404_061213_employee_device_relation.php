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
            'uuid' => $this->char(36),
            'deviceUid' => $this->integer(),
            'employeeId' => $this->integer(),
            'deviceId' => $this->integer(),
            'finger' => $this->smallInteger(1),
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
