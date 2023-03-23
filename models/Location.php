<?php

namespace app\models;

use app\behaviors\UuidBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $uuid
 * @property string $location
 * @property string $address
 * @property int $status 0=Inactive, 1=Active
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Device[] $devices
 */
class Location extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => UuidBehavior::class,
                'uuidAttribute' => 'uuid',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid', 'location', 'address', 'status'], 'required'],
            [['status'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['location'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['uuid'], 'unique'],
            [['location'], 'unique'],
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
            'location' => Yii::t('app', 'Location'),
            'address' => Yii::t('app', 'Address'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Devices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Device::class, ['location' => 'id']);
    }
}
