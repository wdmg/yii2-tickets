<?php

namespace wdmg\tickets\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\tickets\models\Tickets;

/**
 * TicketsSearch represents the model behind the search form of `wdmg\tickets\models\Tickets`.
 */
class TicketsSearch extends Tickets
{

    /**
     * @var model `Tasks`, if exist and available
     */
    public $task;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subunit', 'user_id', 'assigned_id', 'task_id', 'status'], 'integer'],
            [['subject', 'message', 'access_token', 'created_at', 'updated_at'], 'safe'],
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
        $query = Tickets::find();

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
            'subunit' => $this->subunit,
            'user_id' => $this->user_id,
            'assigned_id' => $this->assigned_id,
            'task_id' => $this->task_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'access_token', $this->access_token]);

        return $dataProvider;
    }
}
