<?php

namespace app\controllers;

use Yii;
use app\models\{Menus, Daymenus};
use app\models\MenusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenusController implements the CRUD actions for Menus model.
 */
class MenusController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all Menus models.
     * @return mixed
     */
	 
	public function actionShow($cron=0) {

		//Get Todays Date
		$todayDate = date('Y-m-d',time());
		
		$date_ = $todayDate; 
		$date_ = new \DateTime($date_);
		$date_->modify("+1 day");
		$tomorrowDate = $date_->format('Y-m-d');		
		
		
		


					
		
		$params['today'] = Yii::$app->formatter->asDate($todayDate);
		$params['tomorrow'] = Yii::$app->formatter->asDate($tomorrowDate);
		//if record exist do nothing 
		$modelToday = Menus::getMealToday();
		$modelTomorrow = Menus::getMealTomorrow();
		
		
		
		$params['modelToday'] = $modelToday; 
		$params['modelTomorrow'] = $modelTomorrow; 
		
		
		$sub = "Menu for {$params['today']} and {$params['tomorrow']} ";
		
		
		if($cron == 1) {
			//runs email 
			Yii::$app->mailer->compose('menu',$params) 
				->setFrom('menume@wesvault.com')
				->setTo(Yii::$app->params['toEmail'])
				->setSubject($sub)
				->send();		
			
			
		}
		
		return $this->render('show', $params);
		
	}
	

	public function actionChangeToday() {
		
		$todayDate = date('Y-m-d',time());

		$model = Daymenus::find()->where(['date'=>$todayDate])->one();		
		if(isset($model)) {
			$model->delete();
			Yii::$app->session->setFlash('warning','Menu Changed');
		}
		return $this->redirect('show');
		
	}
	
	public function actionTest() {
		
		print_r(Menus::notLast30());
		
	}


	
	 
    public function actionIndex()
    {
        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menus model.
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
     * Finds the Menus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
