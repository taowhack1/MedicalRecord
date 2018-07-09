<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); 
$this->title = 'test';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="jumbotron"><h1>Medical Record</h1></div>

    
    <div class="inText">  
    	<?= $form->field($model, 'name') ?> 
    	<?= $form->field($model, 'lastname') ?>
    	<?= $form->field($model, 'email') ?>
		<?= $form->field($model, 'mobile') ?>

    </div>

    

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>