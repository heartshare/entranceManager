<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property string $uuid
 * @property int $userId
 * @property int $state 1=FingerPrint, 4=RFID Card, 25=Palm 15=Face
 * @property int $deviceId
 * @property int $companyId
 * @property int $locationId
 * @property string $deviceTime
 * @property int $isSync OPS Sync State 0=No, 1=Yes
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Company $company
 * @property Device $device
 * @property Location $location
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'userId', 'state', 'deviceId', 'companyId', 'locationId', 'deviceTime'], 'required'],
            [['userId', 'state', 'deviceId', 'companyId', 'locationId', 'isSync'], 'integer'],
            [['deviceTime', 'createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['uuid'], 'unique'],
            [['companyId'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['companyId' => 'id']],
            [['deviceId'], 'exist', 'skipOnError' => true, 'targetClass' => Device::class, 'targetAttribute' => ['deviceId' => 'id']],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['locationId' => 'id']],
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
            'userId' => Yii::t('app', 'User ID'),
            'state' => Yii::t('app', 'State'),
            'deviceId' => Yii::t('app', 'Device ID'),
            'companyId' => Yii::t('app', 'Company ID'),
            'locationId' => Yii::t('app', 'Location ID'),
            'deviceTime' => Yii::t('app', 'Device Time'),
            'isSync' => Yii::t('app', 'Is Sync'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'companyId']);
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Device::class, ['id' => 'deviceId']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'locationId']);
    }
}
