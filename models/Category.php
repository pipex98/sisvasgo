<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $state
 *
 * @property Item[] $items
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['state'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 256],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('category', 'Name'),
            'description' => Yii::t('category', 'Description'),
            'state' => Yii::t('category', 'State'),
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }

    public static function getCategories()
    {
        return static::find()
            ->where(['state' => 1])
            ->all();
    }

}
