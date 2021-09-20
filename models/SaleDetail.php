<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_detail".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $item_id
 * @property int $quantity
 * @property float $sale_price
 * @property float $discount
 *
 * @property Item $item
 * @property Sale $sale
 */
class SaleDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'item_id', 'quantity', 'sale_price'], 'required'],
            [['sale_id', 'item_id', 'quantity'], 'integer'],
            [['sale_price', 'discount'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sale::className(), 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'item_id' => 'Item ID',
            'quantity' => 'Quantity',
            'sale_price' => 'Sale Price',
            'discount' => 'Discount',
        ];
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

    /**
     * Gets query for [[Sale]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }

    public static function getDetailsList($id)
    {
        return static::find()
            ->where(['sale_id' => $id])
            ->all();
    }
}
