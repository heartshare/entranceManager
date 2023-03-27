<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_device_relation".
 *
 * @property int $id
 * @property string $uuid
 * @property int $deviceUid
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
            [['employeeId', 'deviceId', 'finger', 'deviceUid'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
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
            'deviceUid' => Yii::t('app', 'Device UID'),
            'employeeId' => Yii::t('app', 'Employee ID'),
            'deviceId' => Yii::t('app', 'Device'),
            'finger' => Yii::t('app', 'Finger'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }
}
