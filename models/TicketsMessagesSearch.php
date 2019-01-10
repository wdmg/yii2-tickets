<?php

namespace wdmg\tickets\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\tickets\models\TicketsMessages;

/**
 * TicketsMessagesSearch represents the model behind the search form of `wdmg\tickets\models\TicketsMessages`.
 */
class TicketsMessagesSearch extends TicketsMessages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ticket_id', 'sender_id', 'attachment_id'], 'integer'],
            [['message', 'created_at', 'updated_at'], 'safe'],
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
        $query = TicketsMessages::find();

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
            'ticket_id' => $this->ticket_id,
            'sender_id' => $this->sender_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'attachment_id' => $this->attachment_id,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
