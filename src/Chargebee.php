<?php
   namespace Ramakrishnan\Chargebee;
    use yii;
   class Chargebee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chargebee';
    }
    public static function getDb()
    {
        return Yii::$app->db3;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_email', 'subscription_id'], 'required'],
            [['customer_id', 'customer_email','subscription_id','paymentsource_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'customer_email' => Yii::t('app', 'Customer Email'),
            'subscription_id' => Yii::t('app', 'Subscription'),
            'paymentsource_id' => Yii::t('app', 'Payment Source'),
        ];
    }

  
}
?>