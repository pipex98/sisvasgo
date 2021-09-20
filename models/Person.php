<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property int $person_type_id
 * @property string $name
 * @property int $document_type_id
 * @property string|null $document_number
 * @property string|null $address
 * @property string|null $picture
 * @property string|null $phone
 * @property string|null $mail
 * @property int|null $state
 *
 * @property DocumentType $documentType
 * @property PersonType $personType
 * @property User $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_type_id', 'name', 'document_type_id'], 'required'],
            [['person_type_id', 'document_type_id', 'state'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['document_number', 'phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 70],
            [['picture'], 'string', 'max' => 255],
            [['mail'], 'string', 'max' => 50],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['document_type_id' => 'id']],
            [['person_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonType::className(), 'targetAttribute' => ['person_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_type_id' => Yii::t('person', 'Person Type ID'),
            'name' => Yii::t('person', 'Name'),
            'document_type_id' => Yii::t('person', 'Document Type ID'),
            'document_number' => Yii::t('person', 'Document Number'),
            'address' => Yii::t('person', 'Address'),
            'phone' => Yii::t('person', 'Phone'),
            'picture' => Yii::t('person', 'Picture'),
            'mail' => Yii::t('person', 'Mail'),
            'state' => Yii::t('person', 'State'),
        ];
    }

    /**
     * Gets query for [[DocumentType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

    /**
     * Gets query for [[PersonType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonType()
    {
        return $this->hasOne(PersonType::className(), ['id' => 'person_type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPersonTypeSupplier()
    {
        return static::find()
            ->where(['person_type_id' => 1, 'state' => '1'])
            ->all();
    }
    public function getPersonTypeClient()
    {
        return static::find()
            ->where(['person_type_id' => 2, 'state' => '1'])
            ->all();
    }
}
