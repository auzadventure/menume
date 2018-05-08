<?php 
use yii\helpers\Html;

$this->title = ' Menu Me - Menu Planner';
?>
<style>

h4 {
	font-size: 20px;
}
.meal {
	font-size:16px;
	margin: 5px 0;
}
</style>

<h1> Show Menu </h1>


<div class="row">

<div class="col-md-6">

<div class="panel panel-info">
  <div class="panel-heading">Menu Today <?=$today?></div>
  <div class="panel-body">
   <em><?=date('D',strtotime($today)) ?> </em>
   <h4><?= $modelToday->menus->cusine ?> </h4>
  <b><?= $modelToday->menus->meal ?></b>
  <p><?= $modelToday->menus->des ?></p></div>
  
</div>

</div>

<div class="col-md-6">

<div class="panel panel-warning">
  <div class="panel-heading">Menu Tomorrow <?=$tomorrow?></div>
  <div class="panel-body">
     <em><?=date('D',strtotime($tomorrow)) ?> </em>
   <h4><?= $modelTomorrow->menus->cusine ?> </h4>
  <b class='meal'><?= $modelTomorrow->menus->meal ?></b>
  <p><?= $modelTomorrow->menus->des ?></p></div>
  
</div>

</div>



</div>
<?= Html::a('Change Menu',['change-today']); ?>


