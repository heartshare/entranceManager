<?php

use yii\db\Migration;

/**
 * Class m230404_061140_device
 */
class m230404_061140_device extends Migration
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
        echo "m230404_061140_device cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(36),
            'name' => $this->string(50),
            'companyId' => $this->integer(),
            'locationId' => $this->integer(),
            'ip' => $this->string(15),
            'port' => $this->integer(6),
            'version' => $this->string(30),
            'osVersion' => $this->string(20),
            'platform' => $this->string(20),
            'fmVersion' => $this->string(20),
            'serialNumber' => $this->string(20),
            'deviceModel' => $this->string(20),
            'isPrimary' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=No, 1=Yes'),
            'deviceStatus' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Disconnected, 1=Connected, 2=Communication Failed, 3=Unknown'),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Inactive, 1=Active'),
            'lastConnectedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

        $this->createIndex('uniqueUid', 'device', 'uuid', true );
        $this->createIndex('username', 'device', 'username', true );
        $this->addForeignKey('companyRel', 'device', 'locationId', 'company', 'id');
        $this->addForeignKey('locationRel', 'device', 'locationId', 'location', 'id');
    }

    public function down()
    {

        echo "m230404_061140_device cannot be reverted.\n";
        $this->dropTable('device');
        return false;
    }

}
