<?php

use yii\db\Migration;

/**
 * Class m230826_173827_is_deleted
 */
class m230826_173827_is_deleted extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('User', 'is_deleted', $this->boolean()->defaultValue(false));
        $this->addColumn('Post', 'is_deleted', $this->boolean()->defaultValue(false));



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('User', 'is_deleted');
        $this->dropColumn('Post', 'is_deleted');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230826_173827_is_deleted cannot be reverted.\n";

        return false;
    }
    */
}
