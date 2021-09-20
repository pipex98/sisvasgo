<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_type".
 *
 * @property int $id
 * @property string $description
 *
 * @property Person[] $people
 */
class PersonType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_type_id' => 'id']);
    }

    public static function getPersonType()
    {
        return static::find()
            ->all();
    }
}
