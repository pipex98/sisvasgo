<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property int $client_id
 * @property int $user_id
 * @property int $voucher_type_id
 * @property string|null $voucher_sequence
 * @property string $voucher_number
 * @property string $date_hour
 * @property float $tax
 * @property float $total_sale
 * @property int|null $state
 *
 * @property Person $client
 * @property User $user
 * @property VoucherType $voucherType
 * @property SaleDetail[] $saleDetails
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'user_id', 'voucher_type_id', 'voucher_number', 'tax', 'total_sale'], 'required'],
            [['client_id', 'user_id', 'voucher_type_id', 'state'], 'integer'],
            [['date_hour'], 'safe'],
            [['tax', 'total_sale'], 'number'],
            [['voucher_sequence'], 'string', 'max' => 7],
            [['voucher_number'], 'string', 'max' => 10],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['voucher_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => VoucherType::className(), 'targetAttribute' => ['voucher_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => Yii::t('sale', 'Client ID'),
            'user_id' => Yii::t('sale', 'User ID'),
            'voucher_type_id' => Yii::t('sale', 'Voucher Type ID'),
            'voucher_sequence' => Yii::t('sale', 'Voucher Sequence'),
            'voucher_number' => Yii::t('sale', 'Voucher Number'),
            'date_hour' => Yii::t('sale', 'Date Hour'),
            'tax' => Yii::t('sale', 'Tax'),
            'total_sale' => Yii::t('sale', 'Total Sale'),
            'state' => Yii::t('sale', 'State'),
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Person::className(), ['id' => 'client_id']);
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

    /**
     * Gets query for [[VoucherType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoucherType()
    {
        return $this->hasOne(VoucherType::className(), ['id' => 'voucher_type_id']);
    }

    /**
     * Gets query for [[SaleDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaleDetails()
    {
        return $this->hasMany(SaleDetail::className(), ['sale_id' => 'id']);
    }

    public function getSaleNumber()
    {
        return $this->voucher_sequence . $this->voucher_number;
    }

    public static function getTotalSaleToday()
    {
        $query = new Query();

        $current_date = date('Y-m-d');

        $query->select(['IFNULL(SUM(total_sale),0) AS total_sale'])
            ->from('sale')
            ->where(['DATE(date_hour)' => $current_date]);
        
        $command = $query->createCommand();

        $data = $command->queryOne();

        return $data;
    }

    public function getSalesLastTwelveMonths()
    {
        $query = new Query();

        $query->select(['DATE_FORMAT(date_hour,"%M") AS date, SUM(total_sale) AS total'])
            ->from('sale')
            ->groupBy('MONTH(date_hour)')
            ->orderBy(['date_hour' => SORT_DESC])
            ->limit(12);

        $command = $query->createCommand();

        $data = $command->queryAll();

        return $data;
    }

    public function getSalesDateClient($start_date, $end_date, $id)
    {
        $query = new Query();

        $query->select(['DATE(s.date_hour) as date, u.username as user, p.name as client, vt.name as voucher,
        CONCAT(s.voucher_sequence, s.voucher_number) as number, s.total_sale as total_sale, s.tax, s.state'])
            ->from('sale s')
            ->innerJoin('person p', 's.client_id = p.id')
            ->innerJoin('user u', 's.user_id = u.id')
            ->innerJoin('voucher_type vt', 's.voucher_type_id = vt.id')
            ->where(['between','DATE(s.date_hour)',$start_date, $end_date])
            ->andWhere(['client_id' => $id]);

        $command = $query->createCommand();

        $data = $command->queryAll();

        return $data;
    }
    
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->date_hour = new Expression('NOW()');
        }
        return parent::beforeSave($insert);
    }
}
