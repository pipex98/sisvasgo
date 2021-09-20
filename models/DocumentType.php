<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Person[] $people
 */
class DocumentType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['document_type_id' => 'id']);
    }

    public static function getDocumentType()
    {
        return static::find()
            ->all();
    }
}
