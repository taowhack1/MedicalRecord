<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

?>

<div class="col-lg-8" style="align-items: center;">
 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'TR_ID',
        'TR_Date:date',
        'Employee_Em_ID',
        'TR_Symptom',
       	'TR_Treatment',
        'TR_Status',
        'Nurse_N_ID',
    ],
]) ?>
</div>