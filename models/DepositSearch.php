<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Deposit;

/**
 * DepositSearch represents the model behind the search form of `app\models\Deposit`.
 */
class DepositSearch extends Deposit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'user_id', 'voucher_type_id', 'state'], 'integer'],
            [['voucher_sequence', 'voucher_number', 'date_hour'], 'safe'],
            [['tax', 'total_purchase'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Deposit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'supplier_id' => $this->supplier_id,
            'user_id' => $this->user_id,
            'voucher_type_id' => $this->voucher_type_id,
            'date_hour' => $this->date_hour,
            'tax' => $this->tax,
            'total_purchase' => $this->total_purchase,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'voucher_sequence', $this->voucher_sequence])
            ->andFilterWhere(['like', 'voucher_number', $this->voucher_number]);

        return $dataProvider;
    }
}
