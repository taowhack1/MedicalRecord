<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "treatmentrecord".
 *
 * @property string $TR_ID รหัสบันทึก
 * @property string $TR_Date วันที่รักษา
 * @property string $TR_TimeStamp เวลาที่รักษา
 * @property string $Employee_Em_ID 'รหัสพนักงาน'
 * @property string $TR_Symptom 'อาการ'
 * @property string $TR_Treatment การรักษา
 * @property int $TR_Rest พักกี่ชั่วโมง
 * @property string $TR_StartRest เริ่มพัก
 * @property string $TR_EndRest หมดเวลาพัก
 * @property int $TR_Status สถานะ
 * @property string $Nurse_N_ID พยาบาลที่รักษา
 * @property string $TreatmentRecordcol
 *
 * @property Employee $employeeEm
 * @property Nurse $nurseN
 * @property TreatmentrecordHasDrug[] $treatmentrecordHasDrugs
 * @property Drug[] $drugDs
 */
class Treatmentrecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'treatmentrecord';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['TR_ID', 'Employee_Em_ID', 'Nurse_N_ID'], 'required'],
            [['TR_Date', 'TR_StartRest','TR_Update', 'TR_EndRest'], 'safe'],
            [['TR_Rest', 'TR_Status'], 'integer'],
            [['TR_ID'], 'string', 'max' => 10],
            [['Employee_Em_ID'], 'string', 'max' => 8],
            [['TR_Symptom', 'TR_Treatment'], 'string', 'max' => 150],
            [['Nurse_N_ID'], 'string', 'max' => 5],
            [['TreatmentRecordcol'], 'string', 'max' => 45],
            [['TR_ID'], 'unique'],
            //[['Employee_Em_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['Employee_Em_ID' => 'Em_ID']],
            //[['Nurse_N_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Nurse::className(), 'targetAttribute' => ['Nurse_N_ID' => 'N_ID']],
        ];
    }
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'TR_Date',
                'updatedAtAttribute' => 'TR_Update',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TR_ID' => 'รหัสบันทึก',
            'TR_Date' => 'วันที่รักษา',
            'Employee_Em_ID' => '\'รหัสพนักงาน\'',
            'TR_Symptom' => '\'อาการ\'',
            'TR_Treatment' => 'การรักษา',
            'TR_Rest' => 'พักกี่ชั่วโมง',
            'TR_StartRest' => 'เริ่มพัก',
            'TR_EndRest' => 'หมดเวลาพัก',
            'TR_Status' => 'สถานะ',
            'Nurse_N_ID' => 'พยาบาลที่รักษา',
            'TreatmentRecordcol' => 'Treatment Recordcol',
            'TR_Update' => 'วันที่อัพเดท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeEm()
    {
        return $this->hasOne(Employee::className(), ['Em_ID' => 'Employee_Em_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNurseN()
    {
        return $this->hasOne(Nurse::className(), ['N_ID' => 'Nurse_N_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentrecordHasDrugs()
    {
        return $this->hasMany(TreatmentrecordHasDrug::className(), ['TreatmentRecord_TR_ID' => 'TR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDrugDs()
    {
        return $this->hasMany(Drug::className(), ['D_ID' => 'Drug_D_ID'])->viaTable('treatmentrecord_has_drug', ['TreatmentRecord_TR_ID' => 'TR_ID']);
    }
}
