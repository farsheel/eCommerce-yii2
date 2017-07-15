<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblOrder;

/**
 * OrderSearch represents the model behind the search form about `app\models\TblOrder`.
 */
class OrderSearch extends TblOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_int_order_id', 'fk_int_customer_id'], 'integer'],
            [['date_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = TblOrder::find();

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
            'pk_int_order_id' => $this->pk_int_order_id,
            'fk_int_customer_id' => $this->fk_int_customer_id,
            'date_date' => $this->date_date,
        ]);

        return $dataProvider;
    }
}
