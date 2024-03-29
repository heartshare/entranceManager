<?php

namespace app\models;

use app\behaviors\UuidBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $uuid
 * @property int $userId
 * @property int $role 0=User, 14=SuperAdmin
 * @property string|null $name
 * @property string|null $password
 * @property string|null $cardNo
 * @property string|null $finger
 * @property int $status 0=Sync 1=FingerSync 2=Completed
 * @property string $createdAt
 * @property string $updatedAt
 */
class Employee extends \yii\db\ActiveRecord
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
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'role', 'name', 'status'], 'required'],
            [['role', 'status', 'userId'], 'integer'],
            [['finger'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['password'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 50],
            [['cardNo'], 'string', 'max' => 20],
            [['userId'], 'unique'],
            [['uuid'], 'unique'],
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
            'role' => Yii::t('app', 'Role'),
            'name' => Yii::t('app', 'Name'),
            'password' => Yii::t('app', 'Password'),
            'cardNo' => Yii::t('app', 'Card No'),
            'finger' => Yii::t('app', 'Finger'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }
}
