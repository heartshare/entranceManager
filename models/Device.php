<?php

namespace app\models;

use app\behaviors\UuidBehavior;
use app\library\zkteco\ZKTeco;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $company
 * @property int $location
 * @property string $ip
 * @property int $port
 * @property string $version
 * @property string $osVersion
 * @property string $platform
 * @property string $fmVersion
 * @property string $serialNumber
 * @property string $deviceModel
 * @property int $status 0=Inactive, 1=Active,
 * @property int $deviceStatus 0=Disconnected, 1=Connected,2=Communication Failed,3=Unknown
 2=Communication Error
 * @property string $lastConnectedAt
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Company $company0
 * @property Location $location0
 */
class Device extends \yii\db\ActiveRecord
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt', 'lastConnectedAt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt', 'lastConnectedAt'],
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
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company', 'location', 'ip'], 'required'],
            ['name', 'deviceCheck'],
            [['ip'], 'ip', 'ipv6' => false], // IPv4 address (IPv6 is disabled)
            [['company', 'location', 'port', 'status', 'deviceStatus'], 'integer'],
            [['lastConnectedAt', 'createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 15],
            [['version'], 'string', 'max' => 30],
            [['osVersion', 'platform', 'fmVersion', 'serialNumber'], 'string', 'max' => 20],
            [['deviceModel'], 'string', 'max' => 25],
            [['uuid', 'name'], 'unique'],
            [['company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company' => 'id']],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location' => 'id']],
        ];
    }

    public function deviceCheck($attribute, $params)
    {

        if($this->ip && $this->port){
            $zk = new ZKTeco($this->ip,  $this->port, 5);
           if($zk->connect()){
               $this->version = $zk->version();
               $this->osVersion = $zk->osVersion();
               $this->platform = $zk->platform();
               $this->fmVersion = $zk->fmVersion();
               $this->serialNumber = $zk->serialNumber();
               $this->deviceModel = $zk->deviceModel();
               $this->deviceStatus = 1;
               $this->status = 1;
           }else{
               $this->status = 0;
               $this->addError($attribute, Yii::t('app', "The device must be connected, before you add."));
           }
        }else{
            $this->addError($attribute, Yii::t('app', "IP and Port can't be empty."));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'name' => Yii::t('app', 'Name'),
            'company' => Yii::t('app', 'Company'),
            'location' => Yii::t('app', 'Location'),
            'ip' => Yii::t('app', 'IP Address'),
            'port' => Yii::t('app', 'Port'),
            'version' => Yii::t('app', 'Version'),
            'osVersion' => Yii::t('app', 'Os Version'),
            'platform' => Yii::t('app', 'Platform'),
            'fmVersion' => Yii::t('app', 'Fm Version'),
            'serialNumber' => Yii::t('app', 'Serial Number'),
            'deviceModel' => Yii::t('app', 'Device Model'),
            'status' => Yii::t('app', 'Status'),
            'deviceStatus' => Yii::t('app', 'Device'),
            'lastConnectedAt' => Yii::t('app', 'Last Connected At'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Company0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(Company::class, ['id' => 'company']);
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::class, ['id' => 'location']);
    }
}
