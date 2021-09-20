<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deposit_detail".
 *
 * @property int $id
 * @property int $deposit_id
 * @property int $item_id
 * @property int $quantity
 * @property float $price_purchase
 * @property float $price_sale
 *
 * @property Deposit $deposit
 * @property Item $item
 */
class DepositDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposit_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deposit_id', 'item_id', 'quantity', 'price_purchase', 'price_sale'], 'required'],
            [['deposit_id', 'item_id', 'quantity'], 'integer'],
            [['price_purchase', 'price_sale'], 'number'],
            [['deposit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Deposit::className(), 'targetAttribute' => ['deposit_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'deposit_id' => 'Deposit ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'price_purchase' => 'Price Purchase',
            'price_sale' => 'Price Sale',
        ];
    }

    /**
     * Gets query for [[Deposit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeposit()
    {
        return $this->hasOne(Deposit::className(), ['id' => 'deposit_id']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    public static function getDetailsList($id)
    {
        return static::find()
            ->where(['deposit_id' => $id])
            ->all();
    }

    public static function getItemsActiveSale()
    {
        return static::find()
            ->all();
    }
}
