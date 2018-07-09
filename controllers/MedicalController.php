<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\SearchForm;
use app\models\Employee;
use app\models\Treatmentrecord;
use app\models\TreatmentrecordHasDrug;
use app\models\Drug;
use app\models\Nurse;
use app\models\MedicalSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\models\DrugSearch;

class MedicalController extends Controller
{

    public $count = 0;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
       $searchModel = new MedicalSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       $model = new Treatmentrecord();
        return $this->render('index',['searchModel'=>$searchModel,'dataProvider'=>$dataProvider]);
    }

	public function actionView($Em_ID){
        $tr = new Treatmentrecord();
        $drug = new Drug();
        $nurse = new Nurse();
        $hDrug = new TreatmentrecordHasDrug();

        $result = $this->findModel($Em_ID);
        //$items = ArrayHelper::map(Drug::find()->all(), 'D_ID', 'D_Name');
        $trCount = Treatmentrecord::find()->count();
        if($result == null){
            $key = new Employee();
            return $this->redirect(['search']);
        }else{

            $trEm = $this->Findtr($result);
            $hDEm = array();
            foreach ($trEm as $value) {
                $query = (new \yii\db\Query())
                            ->select('treatmentrecord.Employee_Em_ID , treatmentrecord_has_drug.TreatmentRecord_TR_ID , treatmentrecord_has_drug.Drug_D_ID , drug.D_Name , treatmentrecord_has_drug.D_Amount')
                            ->from('treatmentrecord_has_drug')
                            ->innerJoin('drug', 'treatmentrecord_has_drug.Drug_D_ID = drug.D_ID')
                            ->innerJoin('treatmentrecord', 'treatmentrecord_has_drug.TreatmentRecord_TR_ID = treatmentrecord.TR_ID')
                            ->where('treatmentrecord_has_drug.TreatmentRecord_TR_ID = :tr_id', [':tr_id' => $value->TR_ID])
                            ->orderby(['treatmentrecord.TR_Date'=>SORT_DESC]);
                    $command = $query->createCommand();
                    $mdr = $command->queryAll();

                //$findDrug = TreatmentrecordHasDrug::find()->where(['Treatmentrecord_TR_ID' => $value->TR_ID])->all();
                array_push($hDEm,$mdr);
            }

             $trEm = Treatmentrecord::find()->where(['Employee_Em_ID' => $result->Em_ID])
                    ->orderby(['TR_Date'=>SORT_DESC])->limit(5)->all();

             return $this->render('result',['key' => $result,
                 'tr' => $tr, 'drug' => $drug ,'count'=>$trCount, 'hDrug' => $hDrug, 'trEm'=>$trEm, 'hDEm'=>$hDEm]);

        }
	}

    public function Findtr($id){

        $value = Treatmentrecord::find()->where(['Employee_Em_ID' => $id->Em_ID])
        ->orderby(['TR_Date'=>SORT_DESC])->limit(5)->all();


        return $value;
    }

   public function actionUpdate($id)
    {
        $model = $this->findMR($id);
        $hD    = $this->findHD($id);
        if ($model->load(Yii::$app->request->post()) && $model->save() && $hD->save()) {
            return $this->redirect(['view','Em_ID' => $model->Employee_Em_ID]);
        }

        return $this->render('update',['model'=>$model,'hD'=>$hD]);

    }


    public function actionSearch(){
        $key = new Employee();
        if ($key->load ( Yii::$app->request->post() )  ) {
            $this -> count++;
            return $this->redirect(['view','Em_ID' => $key->Em_ID]);
        }else{
            $this -> count++;
            return $this->render('view',['key' => $key]);
    }
}

    public function actionCreate($Em_ID)
    {
        $tr = new Treatmentrecord();
        $hDrug = new TreatmentrecordHasDrug();
        $modelsDrug = [new TreatmentrecordHasDrug];
        $trCount = Treatmentrecord::find()->count();

        if ($tr->load(Yii::$app->request->post())) {

            $modelsDrug = Model::createMultiple(TreatmentrecordHasDrug::classname());
            Model::loadMultiple($modelsDrug , Yii::$app->request->post());

            // validate all models
            $valid = $tr->validate();
            $valid = Model::validateMultiple($modelsDrug) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $tr->save(false)) {
                        foreach ($modelsDrug as $modelDrug) {
                            $modelDrug->Treatmentrecord_TR_ID = $tr->TR_ID;
                            if (! ($flag = $modelDrug->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'Em_ID' => $tr->Employee_Em_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        $result = $this->findModel($Em_ID);

        return $this->render('record', [
            'key' => $result,
            'tr' => $tr,
            'hDrug' => $hDrug,
            'count' => $trCount,
            'modelsDrug' => (empty($modelsDrug)) ? [new TreatmentrecordHasDrug] : $modelsDrug
        ]);
    }


    protected function findModel($id)
    {
        if (($key = Employee::findOne($id)) !== null) {
            return $key;
        }else{
            return null;
        }

    }
    protected function findMR($id)
    {
        if (($model = Treatmentrecord::findOne($id)) !== null) {
            return $model;
        }else{
            return null;
        }
    }
    protected function findHD($id)
    {
        if (($model = TreatmentrecordHasDrug::findOne($id)) !== null) {
            return $model;
        }else{
            return null;
        }
    }

    protected function findModeltr($id)
    {
        if (($model = Treatmentrecord::findOne($id)) !== null) {
            return $model;
        }else{
            return null;
        }

    }
    public function actionDrug()
    {
        $searchModel = new DrugSearch();
        $Drug = new Drug();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('drug_list',['searchModel'=>$searchModel,'dataProvider'=>$dataProvider,'Drug'=>$Drug]);

    }

    public function actionDelete($id,$Em_ID)
    {
        TreatmentrecordHasDrug::deleteAll(['Treatmentrecord_TR_ID'=>$id]);

        $this->findModeltr($id)->delete();
        

        return $this->redirect(['view','Em_ID' => $Em_ID]);
    }

    public function actionDeleteindex($id)
    {
        TreatmentrecordHasDrug::deleteAll(['Treatmentrecord_TR_ID'=>$id]);

        $this->findModeltr($id)->delete();
        

        return $this->redirect(['index']);
    }

    public function actionViewindex($id)
    {
        $model = Treatmentrecord::findOne($id);
        return $this->render('_form',['model'=>$model]);
    }
    public function actionUpdateindex($id)
    {
        $model = $this->findMR($id);
        $hD    = $this->findHD($id);
        if ($model->load(Yii::$app->request->post()) && $model->save() && $hD->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update',['model'=>$model,'hD'=>$hD]);

    }
}