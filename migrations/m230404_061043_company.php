<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230404_061043_company
 */
class m230404_061043_company extends Migration
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
        echo "m230404_061043_company cannot be reverted.\n";
        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'uuid' => $this->string(36),
            'name' => $this->string(100),
            'status' => $this->smallInteger(1)->defaultValue(0)->notNull()->comment('0=Inactive, 1=Active'),
            'createdAt' => $this->timestamp()->defaultExpression('NOW()')->notNull(),
            'updatedAt' => $this->timestamp()->defaultExpression('NOW()')->notNull()
        ]);

        $this->createIndex('uniqueUid', 'company', 'uuid', true );
    }

    public function down()
    {

        echo "m230404_061043_company cannot be reverted.\n";
        $this->dropTable('company');
        return false;
    }

}
