<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nurse".
 *
 * @property string $N_ID รหัสพยาบาล
 * @property string $N_Prefix คำนำหน้าชื่อ
 * @property string $N_fName ชื่อ
 * @property string $N_lName สกุล
 * @property string $N_Gender เพศ
 * @property string $N_IDCard รหัสประชาชน
 *
 * @property Treatmentrecord[] $treatmentrecords
 */
class Nurse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nurse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['N_ID'], 'required'],
            [['N_ID'], 'string', 'max' => 5],
            [['N_Prefix'], 'string', 'max' => 4],
            [['N_fName', 'N_lName'], 'string', 'max' => 45],
            [['N_Gender'], 'string', 'max' => 1],
            [['N_IDCard'], 'string', 'max' => 13],
            [['N_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'N_ID' => 'รหัสพยาบาล',
            'N_Prefix' => 'คำนำหน้าชื่อ',
            'N_fName' => 'ชื่อ',
            'N_lName' => 'สกุล',
            'N_Gender' => 'เพศ',
            'N_IDCard' => 'รหัสประชาชน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentrecords()
    {
        return $this->hasMany(Treatmentrecord::className(), ['Nurse_N_ID' => 'N_ID']);
    }

    public function getFullname()
    {
        return $this->N_ID.' '.$this->N_fName;
    }
}
