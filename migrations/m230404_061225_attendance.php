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
        $this->createTable('attendance', [
            'id' => $this->primaryKey(),
            'uuid' => $this->char(36),
            'userId' => $this->integer(),
            'state' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('1=FingerPrint, 4=RFID Card, 25=Palm 15=Face'),
            'deviceId' => $this->integer(),
            'companyId' => $this->integer(),
            'locationId' => $this->integer(),
            'deviceTime' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'isSync' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('OPS Data Sync State: 0=No, 1=Yes '),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

    }

    public function down()
    {

        echo "m230404_061225_attendance cannot be reverted.\n";
        $this->dropTable('attendance');
        return false;
    }

}
