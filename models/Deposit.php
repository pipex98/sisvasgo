<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "deposit".
 *
 * @property int $id
 * @property int $supplier_id
 * @property int $user_id
 * @property int $voucher_type_id
 * @property string|null $voucher_sequence
 * @property string $voucher_number
 * @property string $date_hour
 * @property float $tax
 * @property float $total_purchase
 * @property int|null $state
 *
 * @property Person $supplier
 * @property User $user
 * @property VoucherType $voucherType
 * @property DepositDetail[] $depositDetails
 */
class Deposit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_id', 'user_id', 'voucher_type_id', 'voucher_number', 'tax', 'total_purchase'], 'required'],
            [['supplier_id', 'user_id', 'voucher_type_id', 'state'], 'integer'],
            [['date_hour'], 'safe'],
            [['tax', 'total_purchase'], 'number'],
            [['voucher_sequence'], 'string', 'max' => 7],
            [['voucher_number'], 'string', 'max' => 10],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['supplier_id' => 'id']],
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
            'id' => Yii::t('deposit', 'ID'),
            'supplier_id' => Yii::t('deposit', 'Supplier ID'),
            'user_id' => Yii::t('deposit', 'User ID'),
            'voucher_type_id' => Yii::t('deposit', 'Voucher Type ID'),
            'voucher_sequence' => Yii::t('deposit', 'Voucher Sequence'),
            'voucher_number' => Yii::t('deposit', 'Voucher Number'),
            'date_hour' => Yii::t('deposit', 'Date Hour'),
            'tax' => Yii::t('deposit', 'Tax'),
            'total_purchase' => Yii::t('deposit', 'Total Purchase'),
            'state' => Yii::t('deposit', 'State'),
        ];
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Person::className(), ['id' => 'supplier_id']);
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
     * Gets query for [[DepositDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepositDetails()
    {
        return $this->hasMany(DepositDetail::className(), ['deposit_id' => 'id']);
    }

    public function getDepositNumber()
    {
        return $this->voucher_sequence . $this->voucher_number;
    }

    public static function getTotalPurchaseToday()
    {

        $query = new Query();

        $current_date = date('Y-m-d');

        $query->select(['IFNULL(SUM(total_purchase),0) AS total_purchase'])
            ->from('deposit')
            ->where(['DATE(date_hour)' => $current_date]);
        
        $command = $query->createCommand();

        $data = $command->queryOne();

        return $data;
    }

    public static function getPurchasesLastTenDays()
    {
        $query = new Query();

        $query->select(['CONCAT(DAY(date_hour),"-",MONTH(date_hour)) AS date',
            'SUM(total_purchase) AS total'  
        ])
        ->from('deposit')
        ->groupBy('date_hour')
        ->orderBy(['date_hour' => SORT_DESC])
        ->limit(10);

        $command = $query->createCommand();
        
        $data = $command->queryAll();

        return $data;
    }

    public static function getPurchasesDate($start_date, $end_date)
    {
        $query = new Query();

        $query->select(['DATE(d.date_hour) as date, u.username as user, p.name as supplier, 
        vt.name as voucher, CONCAT(d.voucher_sequence, d.voucher_number) AS number, 
        d.total_purchase, d.tax, 
        d.state'])
            ->from('deposit d')
            ->innerJoin('person p', 'd.supplier_id = p.id')
            ->innerJoin('user u', 'd.user_id = u.id')
            ->innerJoin('voucher_type vt', 'd.voucher_type_id = vt.id')
            ->where(['between','DATE(d.date_hour)',$start_date, $end_date]);
        
        $command = $query->createCommand();

        $data = $command->queryAll();

        return $data;
    }

    /** 
     * @return \yii\db\ActiveQuery
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->date_hour = new Expression('NOW()');
        }
        return parent::beforeSave($insert);
    }
}
