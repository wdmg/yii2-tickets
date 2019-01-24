<?php

namespace wdmg\tickets\models;

use Yii;
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
     * @var model `Users`, if exist and available
     */
    public $owner;

    /**
     * @var model `Users`, if exist and available
     */
    public $executor;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subunit_id', 'user_id', 'assigned_id', 'status'], 'integer'],
            [['subject', 'task_id', 'message', 'access_token', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params, $current_user = null)
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

        // if need load custom user
        if($current_user)
            $this->user_id = $current_user;

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'subunit_id' => $this->subunit_id,
            'user_id' => $this->user_id,
            'assigned_id' => $this->assigned_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        // custom search: get task_id requested by title
        if(!is_int($this->task_id) && !empty($this->task_id) && (class_exists('\wdmg\tasks\models\Tasks') && isset(Yii::$app->modules['tasks']))) {
            $task_id = \wdmg\tasks\models\Tasks::find()->andFilterWhere(['like', 'title', $this->task_id])->one();
            $query->andFilterWhere(['task_id' => $task_id]);
        } else {
            $query->andFilterWhere(['task_id' => $this->task_id]);
        }

        $query->andFilterWhere(['like', 'subject', $this->subject])->andFilterWhere(['like', 'message', $this->message])->andFilterWhere(['like', 'access_token', $this->access_token]);

        return $dataProvider;
    }
}
