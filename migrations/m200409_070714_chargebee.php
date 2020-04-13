<?php

use yii\db\Migration;

/**
 * Class m200409_070714_chargebee
 */
class m200409_070714_chargebee extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('chargebee', [
            'id' =>  $this->primaryKey(),
            'customer_id' => $this->string(),
            'customer_email' => $this->string()->unique(),
            'subscription_id' => $this->string(),
            'paymentsource_id'=> $this->string(),
           
        ]);
        
    }

    public function safeDown()
    {
         $this->dropTable('chargebee');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200409_070714_chargebee cannot be reverted.\n";

        return false;
    }
    */
}
