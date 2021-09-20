<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Deposit[] $deposits
 */
class VoucherType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Deposits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeposits()
    {
        return $this->hasMany(Deposit::className(), ['voucher_type_id' => 'id']);
    }

    public static function getVouchersType()
    {
        return static::find()
            ->all();
    }
}
