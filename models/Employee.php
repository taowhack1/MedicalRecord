<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $Em_ID 'รหัสพนักงาน'
 * @property string $Em_Dep 'แผนก'
 * @property string $Em_Prefix 'คำนำหน้าชื่อ'
 * @property string $Em_fName 'ชื่อ'
 * @property string $Em_lName 'สกุล'
 * @property string $Em_PrefixEn 'คำนำหน้าชื่ออังกฤษ'
 * @property string $Em_fNameEn 'ชื่ออังกฤษ'
 * @property string $Em_lNameEn 'สกุลอังกฤษ'
 * @property string $Em_Mobile 'เบอร์โทร'
 * @property string $Em_Gender 'เพศ'
 * @property string $Em_Race 'เชื้อชาติ'
 * @property string $Em_Nation 'สัญชาติ'
 * @property string $Em_Relig 'ศาสนา'
 * @property string $Em_BirthDate วันเกิด
 * @property string $Em_IDCard 'บัตรประชาชน'
 * @property string $Em_Shift 'กะ'
 *
 * @property Treatmentrecord[] $treatmentrecords
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Em_ID'], 'required'],
            [['Em_BirthDate'], 'safe'],
            [['Em_ID'], 'string', 'max' => 8],
            [['Em_Dep'], 'string', 'max' => 5],
            [['Em_Prefix', 'Em_PrefixEn'], 'string', 'max' => 4],
            [['Em_fName', 'Em_lName', 'Em_fNameEn', 'Em_lNameEn'], 'string', 'max' => 45],
            [['Em_Mobile', 'Em_Race', 'Em_Nation', 'Em_Relig'], 'string', 'max' => 10],
            [['Em_Gender', 'Em_Shift'], 'string', 'max' => 1],
            [['Em_IDCard'], 'string', 'max' => 13],
            [['Em_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Em_ID' => '\'รหัสพนักงาน\'',
            'Em_Dep' => '\'แผนก\'',
            'Em_Prefix' => '\'คำนำหน้าชื่อ\'',
            'Em_fName' => '\'ชื่อ\'',
            'Em_lName' => '\'สกุล\'',
            'Em_PrefixEn' => '\'คำนำหน้าชื่ออังกฤษ\'',
            'Em_fNameEn' => '\'ชื่ออังกฤษ\'',
            'Em_lNameEn' => '\'สกุลอังกฤษ\'',
            'Em_Mobile' => '\'เบอร์โทร\'',
            'Em_Gender' => '\'เพศ\'',
            'Em_Race' => '\'เชื้อชาติ\'',
            'Em_Nation' => '\'สัญชาติ\'',
            'Em_Relig' => '\'ศาสนา\'',
            'Em_BirthDate' => 'วันเกิด',
            'Em_IDCard' => '\'บัตรประชาชน\'',
            'Em_Shift' => '\'กะ\'',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentrecords()
    {
        return $this->hasMany(Treatmentrecord::className(), ['Employee_Em_ID' => 'Em_ID']);
    }
}
