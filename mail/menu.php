<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>


<h1> MENU Today </h1>


<div class="row">

<div class="col-md-6">


  <h3>Menu Today <?=$today?></h3>
  <br>
   <em><?=date('D',strtotime($today)) ?> </em>
   <h4><?= $modelToday->menus->cusine ?> </h4>
  <b><?= $modelToday->menus->meal ?></b>
  <p><?= $modelToday->menus->des ?></p></div>



<div class="col-md-6">

<h3>Menu Tomorrow <?=$tomorrow?>

     <em><?=date('D',strtotime($tomorrow)) ?> </em>
   <h4><?= $modelTomorrow->menus->cusine ?> </h4>
  <b class='meal'><?= $modelTomorrow->menus->meal ?></b>
  <p><?= $modelTomorrow->menus->des ?></p>
  
</div>

</div>




