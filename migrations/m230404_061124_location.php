<?php

use yii\db\Migration;

/**
 * Class m230404_061124_location
 */
class m230404_061124_location extends Migration
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
        echo "m230404_061124_location cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('location', [
            'id' => $this->primaryKey(),
            'uuid' => $this->char(36),
            'location' => $this->string(50),
            'address' => $this->string(255),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Inactive, 1=Active'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

        $this->createIndex('uniqueUid', 'location', 'uuid', true );
        $this->createIndex('uniqueLocation', 'location', 'location', true );
    }

    public function down()
    {

        echo "m230404_061124_location cannot be reverted.\n";
        $this->dropTable('location');
        return false;
    }

}
