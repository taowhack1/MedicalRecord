<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Drug;
use yii\bootstrap\ActiveForm;

$this->title = "Drug List";
$this->params['breadcrumbs'][] = 'Drug List';

?>

<div class="drug_list">
  <h2>Modal Login Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>
<?php $form = ActiveForm::begin(['id' => 'Create-drug-form']);?>
  <!-- Modal -->
  <div class="col-md-12 col-lg-12">
  		<div class="row">
	            	<div class="col-lg-3 col-md-3 col-xs-3>">
	              <?= $form->field($Drug, 'D_Name')->textInput(['maxlength' => true])
			    	->label('ชื่อยา',['class'=>'label-class'])?>
			    	</div>
			    	<div class="col-lg-3 col-md-3 col-xs-3>">
			    	<?= $form->field($Drug, 'D_Type')->textInput(['maxlength' => true])
			    	->label('ชื่อยา',['class'=>'label-class'])?>
			    	</div>
		    	</div>
</div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Add Drug</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
            	<div class="row">
	            	<div class="col-lg-3 col-md-3 col-xs-3>">
	              <?= $form->field($Drug, 'D_Name')->textInput(['maxlength' => true])
			    	->label('ชื่อยา',['class'=>'label-class'])?>
			    	</div>
			    	<div class="col-lg-3 col-md-3 col-xs-3>">
			    	<?= $form->field($Drug, 'D_Type')->textInput(['maxlength' => true])
			    	->label('ประเภท',['class'=>'label-class'])?>
			    	</div>
					<div class="col-lg-3 col-md-3 col-xs-3>">
			    	<?= $form->field($Drug, 'D_Type')->dropDownList(
					            ['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']

					    )->label('ประเภท',['class'=>'label-class'])
					    ; ?>
					</div>
		    	</div>
            </div>
            <div class="form-group">
              <?= $form->field($Drug, 'D_Prop')->textarea(['rows' => '2','maxlength' => true])
		    	->label('สรรพคุณ',['class'=>'label-class'])?>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
    </div>
  </div> 
</div>
<?php ActiveForm::end(); ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
	<button type="button" class="pull-right add-item btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" style="width:100px;height:30px;"><i class="glyphicon glyphicon-plus"></i> Add Drug</button>
	<br>
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
      		['class' => 'yii\grid\SerialColumn'],
           		[
	            'attribute' => 'D_ID',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        	'value' => function($model){
		        		return $model->D_ID;
		        	}
	        	
        		],
        		[
	            'attribute' => 'D_Name',
	        	'contentOptions'=>['style'=>'width: 20%;'],
		        	'value' => function($model){
		        		return $model->D_Name;
		        	}
	        	
        		],
        		[
	            'attribute' => 'D_Prop',
	        	'contentOptions'=>['style'=>'width: 50%;'],
		        	'value' => function($model){
		        		return $model->D_Prop;
		        	}
	        	
        		],
        		[
	            'attribute' => 'D_Type',
	        	'contentOptions'=>['style'=>'width: 10%;'],
		        	'value' => function($model){
		        		return $model->D_Type;
		        	}
	        	
        		],
            [
	          'class' => 'yii\grid\ActionColumn',
	          'header' => 'Actions',
	          'headerOptions' => ['style' => 'color:#337ab7'],
	          'template' => '{view}&nbsp;|&nbsp;{update}&nbsp;|&nbsp;{delete}',
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
		               // $url ='index.php?r=medical/viewindex&id='.$model->TR_ID;
		                //return $url;
		            }

		            if ($action === 'update') {
		               // $url ='index.php?r=medical/updateindex&id='.$model->TR_ID;
		               // return $url;
		            }
		            if ($action === 'delete') {
		               // $url ='index.php?r=medical/deleteindex&id='.$model->TR_ID;
		               // return $url;
		            }

		          }
	        ],
       ]
    ]); 
    ?>
</div>
