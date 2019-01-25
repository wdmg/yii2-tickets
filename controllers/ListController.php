<?php

namespace wdmg\tickets\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use wdmg\tickets\models\Tickets;
use wdmg\tickets\models\TicketsSearch;
use wdmg\tickets\models\TicketsMessagesSearch;

/**
 * ListController implements the CRUD actions for Tickets model.
 */
class ListController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public $defaultAction = 'all';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $viewed = array();
        $modules = array();
        $session = Yii::$app->session;

        if(!isset(Yii::$app->modules['users']))
            $modules[] = '«Users»';

        if(!isset(Yii::$app->modules['tasks']))
            $modules[] = '«Tasks»';

        if(isset($session['viewed-flash']) && is_array($session['viewed-flash']))
            $viewed = $session['viewed-flash'];

        if(count($modules) > 0 && !in_array('tickets-need-modules', $viewed) && is_array($viewed)) {
            Yii::$app->getSession()->setFlash(
                'warning',
                Yii::t(
                    'app/modules/tickets',
                    'Some fields may contain limited information. We recommend installing the {modules} {count, plural, =1{module} one{module} few{modules} many{modules} other{modules}} for complete compatibility.',
                    [
                        'modules' => implode(', ', $modules),
                        'count' => count($modules)
                    ]
                )
            );
            $session['viewed-flash'] = array_merge(array_unique($viewed), ['tickets-need-modules']);
        }

        // Set custom view path
        parent::setViewPath('@vendor/wdmg/yii2-tickets/views/tickets');

        return parent::beforeAction($action);
    }

    /**
     * Lists all Tickets models.
     * @return mixed
     */
    public function actionAll()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists only current user assigned Tickets models.
     * @return mixed
     */
    public function actionCurrent($id)
    {
        $model = new Tickets();
        $searchModel = new TicketsSearch();
        $user = $model->getUser(intval($id));

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, intval($id));

        return $this->render('current', [
            'username' => $user->username,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists only auth user assigned Tickets models.
     * @return mixed
     */
    public function actionMy()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app/modules/tickets', 'The requested page does not exist.'));
    }

    /**
     * Finds the Tickets Messages model based on its primary key value.
     *
     * @param integer $id
     * @return Tickets the loaded model or null
     */
    protected function findMessagesModel($id)
    {
        if (($model = TicketsMessagesSearch::find()->where(['ticket_id' => $id])) !== null) {
            return $model;
        }
        return null;
    }
}
