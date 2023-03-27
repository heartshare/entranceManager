<?php

namespace app\components;

use Yii;
use yii\base\Component;

class Constant extends Component
{

    const USER = 0;
    const UNKNOWN_USER = 1;
    const SUPERADMIN = 14;

    const DEVICE_PRIMARY_YES = 1;
    const DEVICE_SECONDARY_YES = 0;

    const COMMON_ACTIVE = 1;
    const COMMON_INACTIVE = 0;

    const DEVICE_STATUS_DISCONNECTED = 0;
    const DEVICE_STATUS_CONNECTED = 1;
    const DEVICE_STATUS_COMMUNICATION_ERROR = 2;
    const DEVICE_STATUS_UNKNOWN = 3;

    const ROLE = [
        self::USER => 'User',
        self::SUPERADMIN => 'SuperAdmin',
        self::UNKNOWN_USER => 'Unknown',
    ];


    const DEVICE_TYPE = [
        self::DEVICE_PRIMARY_YES => 'Primary',
        self::DEVICE_SECONDARY_YES => 'Secondary',
    ];

    const COMMON_STATUS = [
        self::COMMON_ACTIVE => 'Active',
        self::COMMON_INACTIVE => 'Inactive',
    ];

    const DEVICE_STATUS_LIST = [
        self::DEVICE_STATUS_UNKNOWN => 'Unknown',
        self::DEVICE_STATUS_CONNECTED => 'Connected',
        self::DEVICE_STATUS_DISCONNECTED => 'Disconnected',
        self::DEVICE_STATUS_COMMUNICATION_ERROR => 'Communication Error',
    ];


    const ATTENDANCE_SYNC_NO = 0;
    const ATTENDANCE_SYNC_YES = 1;

    const ATTENDANCE_SYNC_LIST = [
        self::ATTENDANCE_SYNC_NO => 'No',
        self::ATTENDANCE_SYNC_YES => 'Yes'
    ];

    const ATTENDANCE_STATE_FINGER = 1;
    const ATTENDANCE_STATE_RFID = 4;
    const ATTENDANCE_STATE_PALM = 25;
    const ATTENDANCE_STATE_FACE = 15;

    const ATTENDANCE_STATE_LIST = [
        self::ATTENDANCE_STATE_FINGER => 'Finger',
        self::ATTENDANCE_STATE_RFID => 'RFID Card',
        self::ATTENDANCE_STATE_PALM => 'Palm',
        self::ATTENDANCE_STATE_FACE => 'Face',
    ];

}