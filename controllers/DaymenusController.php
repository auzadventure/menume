<?php

namespace app\controllers;

use app\models\Daymenus;
use Yii;
use yii\data\ActiveDataProvider;

class DaymenusController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Daymenus::find();
		
	
		$dataProvider = new ActiveDataProvider([
            'query' => $query,
			 'sort'=> ['defaultOrder' => ['date'=>SORT_DESC]]
        ]);
		
		
		return $this->render('index', [
            
            'dataProvider' => $dataProvider,
        ]);
		
		return $this->render('index');
    }
	
	public function actionFlush() {
		

		Yii::$app->db->createCommand()
			->truncateTable('Daymenus')->execute();
		Yii::$app->session->setFlash('warning','Table empty');
		return $this->redirect('index');

		
	}

}
