<?php

namespace app\traits;
use app\behaviors\UuidBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


trait UniversalModelTrait
{

    public function behaviors()
    {

        /*    touch() public method
            Updates a timestamp attribute to the current timestamp.
            $model->touch('lastVisit');
        */
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

}

?>