<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $code
 * @property string $name
 * @property int|null $stock
 * @property string|null $description
 * @property string|null $image
 * @property int|null $state
 *
 * @property DepositDetail[] $depositDetails
 * @property Category $category
 * @property SaleDetail[] $saleDetails
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'stock', 'state'], 'integer'],
            [['code', 'image'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 256],
            [['name'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => Yii::t('item', 'Category ID'),
            'code' => Yii::t('item', 'Code'),
            'name' => Yii::t('item', 'Name'),
            'stock' => Yii::t('item', 'Stock'),
            'description' => Yii::t('item', 'Description'),
            'image' => Yii::t('item', 'Image'),
            'state' => Yii::t('item', 'State'),
        ];
    }

    /**
     * Gets query for [[DepositDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepositDetails()
    {
        return $this->hasMany(DepositDetail::className(), ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[SaleDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaleDetails()
    {
        return $this->hasMany(SaleDetail::className(), ['item_id' => 'id']);
    }

    public function getImageUrl()
    {
        return Yii::$app->request->baseUrl . '/uploads/items/' . $this->image;
    }

    public static function getItemsList()
    {
        return static::find()
            ->where(['state' => 1])
            ->all();
    }
}
