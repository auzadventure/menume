<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "daymenus".
 *
 * @property int $id
 * @property string $date
 * @property int $menuID
 */
class Daymenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daymenus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'menuID'], 'required'],
            [['date'], 'safe'],
            [['menuID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'menuID' => 'Menu ID',
        ];
    }
	
	public function getMenus() {
	
		return $this->hasOne(Menus::className(),['id'=>'menuID']);
		
	}
}
