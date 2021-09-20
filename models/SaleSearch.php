<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sale;

/**
 * SaleSearch represents the model behind the search form of `app\models\Sale`.
 */
class SaleSearch extends Sale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'user_id', 'voucher_type_id', 'state'], 'integer'],
            [['voucher_sequence', 'voucher_number', 'date_hour'], 'safe'],
            [['tax', 'total_sale'], 'number'],
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
        $query = Sale::find();

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
            'client_id' => $this->client_id,
            'user_id' => $this->user_id,
            'voucher_type_id' => $this->voucher_type_id,
            'date_hour' => $this->date_hour,
            'tax' => $this->tax,
            'total_sale' => $this->total_sale,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'voucher_sequence', $this->voucher_sequence])
            ->andFilterWhere(['like', 'voucher_number', $this->voucher_number]);

        return $dataProvider;
    }
}
