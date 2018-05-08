<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menus".
 *
 * @property int $id
 * @property int $cusine
 * @property int $meal
 * @property string $des
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cusine', 'meal', 'des'], 'required'],

            [['des', 'cusine', 'meal'], 'string'],
            [['id'], 'unique'],
        ];
    }
	
	public function cusineA() {
		$a = [
			 'chinese' => 'chinese',
			 'western' => 'western',
			 'other' => 'other',
			
		
			];
		return $a;
		
		
	}
	
	public function mealA() {
		$a = [
				'lunch'=>'lunch',
				'dinner'=>'dinner',
				];
		return $a;	
	}
	
	
	
	
	public static function getMealToday() {
		
		//Get Todays Date
		$todayDate = date('Y-m-d',time());		
		
		$model = Daymenus::find()->where(['date'=>$todayDate])->one();
		if(isset($model)) {
			$modelToday = $model; 
		}
		else {
			// Find Menu
			$modelToday = Menus::getMeal($todayDate);
			
			// Add to Daymenus 		
			if ($modelToday == '') throw new \yii\web\NotFoundHttpException('No more menus available within 30 days');
			$model = new Daymenus;
			$model->date = $todayDate;
			$model->menuID = $modelToday->id;
			$model->save();
			
			$modelToday = $model; 
		}

		return $modelToday; 
	}
	
	public static function getMealTomorrow() {

		$todayDate = date('Y-m-d',time());
		
		$date_ = $todayDate; 
		$date_ = new \DateTime($date_);
		$date_->modify("+1 day");
		$tomorrowDate = $date_->format('Y-m-d');	

	
		$model = Daymenus::find()->where(['date'=>$tomorrowDate])->one();
		if(isset($model)) {
			$modelTomorrow = $model; 
		}
		else {
			// Find Menu
			$modelTomorrow = Menus::getMeal($tomorrowDate);
			
			// Add to Daymenus 		
			if ($modelTomorrow == '') throw new \yii\web\NotFoundHttpException('No more menus available within 30 days');
			$model = new Daymenus;
			$model->date = $tomorrowDate;
			$model->menuID = $modelTomorrow->id;
			$model->save();
			
			$modelTomorrow = $model; 
		}

		return $modelTomorrow;
	}
	
	
	
	public static function getMeal($date) {
		
		$dayName = date('N', strtotime($date));  
		
		if($dayName == 7) {
			// day sunday - western
			$cusine = 'western';
		}
		/* elseif($dayName == 1) {
			$cusine = 'other';
		} */
		else {
			$cusine = '';
		}
		 
		
		
		// day friday - other 
		$q = self::find()
						->where(['NOT IN','id',self::notLast30()])
						->andWhere(	['meal'=>'dinner'])	
						->andFilterWhere( ['cusine'=>$cusine])
						->orderBy(new Expression('rand()'))
						->one();
		return $q;
	}
	
	public static function notLast30() {
		
		$last30 = Daymenus::find()
						->select(['menuID'])
						->orderBy('date DESC')
						->limit(15)
						->asArray()->all();		
		$last30A = ArrayHelper::getColumn($last30,'menuID');
		return $last30A;
	}
	

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cusine' => 'Cusine',
            'meal' => 'Meal',
            'des' => 'Menu Item Description',
        ];
    }
}
