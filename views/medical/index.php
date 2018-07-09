<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Treatmentrecord;
use yii\helpers\ArrayHelper;
use app\models\Nurse;

?>
<div class="medical-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
      		['class' => 'yii\grid\SerialColumn'],
            [
	            'attribute' => 'TR_ID',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        	'value' => function($model){
		        		return $model->TR_ID;
		        	}
	        	
        	],
        	[
	            'attribute' => 'TR_Date',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        	'value' => function($model){
		        		return $model->TR_Date;
		        	}
	        	
        	],
        	[
	            'attribute' => 'Employee_Em_ID',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        	'value' => function($model){
		        		return $model->Employee_Em_ID;
		        	}
	        	
        	],
        	[
	            'attribute' => 'TR_Symptom',
	        	'contentOptions'=>['style'=>'width: 25%;'],
		        	'value' => function($model){
		        		return $model->TR_Symptom;
		        	}
	        	
        	],
        	[
	            'attribute' => 'TR_Treatment',
	        	'contentOptions'=>['style'=>'width: 25%;'],
		        	'value' => function($model){
		        		return $model->TR_Treatment;
		        	}
	        	
        	],
        	[
	            'attribute' => 'TR_Status',
	        	'contentOptions'=>['style'=>'width: 5%;'],
		        	'value' => function($model){
		        		switch ($model->TR_Status) {
		        			case 0:
		        					return 'ปกติ';
		        				break;
		        			case 1:
		        					return 'พัก';
		        				break;
		        			case 2:
		        					return 'ส่งต่อ';
		        				break;
		        			
		        			default:
		        				
		        				break;
		        		}
		        	},
	        	
        	],
        	[
	            'attribute' => 'Nurse_N_ID',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        'value' => function($model){
		        		return $model->Nurse_N_ID;
		        },

	        	'filter' => Html::activeDropDownList($searchModel, 'Nurse_N_ID'
                            , ArrayHelper::map(Nurse::find()->all(), 'N_ID', function($model) {
                                        return $model->getfullname();
                                    }), [
                        'class' => 'form-control',
                        'prompt' => '',
                    ]),
        	],
            [
	          'class' => 'yii\grid\ActionColumn',
	          'header' => 'Actions',

	          'headerOptions' => ['style' => 'color:#337ab7'],
	          'template' => '{view}{update}{delete}',
	          'buttons' => [
	            'view' => function ($url, $model) {
	                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
	                            'title' => Yii::t('app', 'lead-view'),
	                ]);
	            },

	            'update' => function ($url, $model) {
	                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
	                            'title' => Yii::t('app', 'lead-update'),
	                ]);
	            },
	            'delete' => function ($url, $model) {
	                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
	                            'title' => Yii::t('app', 'lead-delete'),
	                            'data' => [
					                'confirm' => 'Are you sure you want to delete this item?',
					                'method' => 'post',
					            ],
	                ]);
	            }
					         
		       ],
		          'urlCreator' => function ($action, $model, $key, $index) {
		            if ($action === 'view') {
		                $url ='index.php?r=medical/viewindex&id='.$model->TR_ID;
		                return $url;
		            }

		            if ($action === 'update') {
		                $url ='index.php?r=medical/updateindex&id='.$model->TR_ID;
		                return $url;
		            }
		            if ($action === 'delete') {
		                $url ='index.php?r=medical/deleteindex&id='.$model->TR_ID;
		                return $url;
		            }

		          }
	        ],
       ]
    ]); 
    ?>
</div>
