<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblStatus;

/**
 * StatusSearch represents the model behind the search form about `app\models\TblStatus`.
 */
class StatusSearch extends TblStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_int_status_id'], 'integer'],
            [['vchr_status'], 'safe'],
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
        $query = TblStatus::find();

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
            'pk_int_status_id' => $this->pk_int_status_id,
        ]);

        $query->andFilterWhere(['like', 'vchr_status', $this->vchr_status]);

        return $dataProvider;
    }
}
