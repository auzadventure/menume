<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

?>
<h1>daymenus/index</h1>


<?= Html::a('Empty Table',['flush'],['class'=>'btn btn-warning']) ?>

<p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        
        'date:date',
		'menus.cusine',
		'menus.meal',
        ['label'=>'Menu Item No',
		 'value'=> function($model) {
						return Html::a($model->menuID,['menus/view','id'=>$model->menuID]);
					},
		 'format'=>'html',
		],
		
    ],
]) ?>


</p>
