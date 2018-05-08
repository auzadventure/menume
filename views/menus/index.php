<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'id',
			 'filterOptions'=> ['style'=>'width:50px'],
			 'attribute'=>'id',
			 ],
            ['label'=>'Cusine',
			 'attribute'=>'cusine',
			 'filter'=> $searchModel->cusineA(),
			  'filterOptions'=> ['style'=>'width:100px'],
			 ],
            ['label'=>'Meal',
			 'attribute'=>'meal',
			 'filter'=> $searchModel->mealA(),
			  'filterOptions'=> ['style'=>'width:100px'],
			 ],
            'des:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
