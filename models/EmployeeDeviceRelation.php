<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_device_relation".
 *
 * @property int $id
 * @property string $uuid
 * @property string $deviceUid
 * @property int $employeeId
 * @property int $deviceId
 * @property int $finger
 * @property string $createdAt
 * @property string $updatedAt
 */
class EmployeeDeviceRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_device_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'employeeId', 'deviceId', 'createdAt', 'updatedAt'], 'required'],
            [['employeeId', 'deviceId', 'finger'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['deviceUid'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'deviceUid' => Yii::t('app', 'Device User ID'),
            'employeeId' => Yii::t('app', 'Employee ID'),
            'deviceId' => Yii::t('app', 'Device ID'),
            'finger' => Yii::t('app', 'Finger'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }
}
