<?php

namespace wdmg\tickets\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use wdmg\tickets\models\Tickets;
use wdmg\tickets\models\TicketsSearch;
use wdmg\tickets\models\TicketsMessages;
use wdmg\tickets\models\TicketsMessagesSearch;

/**
 * ItemController implements the CRUD actions for Tickets model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true
                    ],
                ],
            ]
        ];

        // If auth manager not configured use default access control
        if(!Yii::$app->authManager) {
            $behaviors['access'] = [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'roles' => ['@'],
                        'allow' => true
                    ],
                ]
            ];
        }

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $viewed = array();
        $modules = array();
        $session = Yii::$app->session;

        if (!$this->module->moduleLoaded('users'))
            $modules[] = '«Users»';

        if (!$this->module->moduleLoaded('tasks'))
            $modules[] = '«Tasks»';

        if (isset($session['viewed-flash']) && is_array($session['viewed-flash']))
            $viewed = $session['viewed-flash'];

        if (count($modules) > 0 && !in_array('tickets-need-modules', $viewed) && is_array($viewed)) {
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

        parent::setViewPath('@vendor/wdmg/yii2-tickets/views/tickets');
        return parent::beforeAction($action);
    }

    /**
     * Go back to all Tickets models from /tickets/list/all.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->goBack(['tickets/list/all']);
    }

    /**
     * Displays a single Tickets model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $messages = $this->findMessagesModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => $messages->orderBy('created_at'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->save())
                Yii::$app->getSession()->setFlash(
                    'success',
                    Yii::t('app/modules/tickets', 'Ticket has been successfully updated!')
                );
            else
                Yii::$app->getSession()->setFlash(
                    'danger',
                    Yii::t('app/modules/tickets', 'An error occurred while updating the ticket.')
                );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tickets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Update some fields in existing Tickets model.
     * If updating is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSet($id)
    {
        $model = $this->findModel($id);
        $params = \Yii::$app->request->get();
        $fields = $model->getAttributes();

        if(is_array($params)) {
            foreach ($params as $param => $value) {
                if(array_key_exists($param, $fields))
                    $model->setAttribute($param, $value);
            }
        }

        if($model->update())
            Yii::$app->getSession()->setFlash(
                'success',
                Yii::t('app/modules/tickets', 'Ticket has been successfully updated!')
            );
        else
            Yii::$app->getSession()->setFlash(
                'danger',
                Yii::t('app/modules/tickets', 'An error occurred while updating the ticket.')
            );

        return $this->redirect(['view', 'id' => $model->id]);
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
