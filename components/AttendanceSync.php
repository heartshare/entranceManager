<?php

namespace app\components;

use app\library\zkteco\Helper\Util;
use app\library\zkteco\ZKTeco;
use app\models\Attendance;
use app\models\Device;
use DateTime;
use DateTimeZone;
use Ramsey\Uuid\Nonstandard\Uuid;
use Yii;
use yii\base\Component;

class AttendanceSync extends Component
{

    public static function allSample()
    {
        //$zk = new ZKTeco('118.179.202.220', 43705, 5); //Old Version Device
        $zk = new ZKTeco('118.179.202.221', 43707, 5); //New Device
        //$zk = new ZKTeco('123.0.20.194', 50501, 5); //New Device Deshi

        //$zk = new ZKLibrary('118.179.202.220', 43705);  //Old Version Device
        //$zk = new ZKLibrary('118.179.202.221', 43707); //New Device

        $zk->connect();
        //dd($zk->pinWidth());
        //dd($zk->workCode());
        //dd($zk->ssr());
//        dd($zk->version());
//        dd($zk->osVersion());
//        dd($zk->platform());
//        dd($zk->fmVersion());
//        dd($zk->serialNumber());
//        dd($zk->deviceModel());
//        dd($zk->getTime());
        //dd($zk->getFingerprint(1));
        //dd($zk->sleep());
        //$zk->removeUser(2);
        dd($zk->getUser());
        dd($zk->setUser(3, 45, 'Mehedee', '', Util::LEVEL_USER, 123465));
        //$zk->disableDevice();
        //dd($zk->clearAttendance());
        //dd($zk->faceFunctionOn());
        //dd($zk->getAttendance($zk->deviceModel()));
    }


    private function isToday($date1, $date2)
    {
        date_default_timezone_set('Asia/Dhaka');
        try {
            $d1 = new DateTime(date("Y-m-d", strtotime($date1)));
            $d2 = new DateTime(date("Y-m-d", strtotime($date2)));
            if ($d1 == $d2) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @param $date1
     * @param $date2
     * @return bool|void
     */
    private function last30Mins($date2)
    {
        try {
            $timezone = new DateTimeZone('Europe/Bucharest');
            $datetime = new DateTime();
            $datetime->setTimezone($timezone);
            echo $datetime->format('Y-m-d H:i:s');
            $datetime->modify("-30 minutes");
            echo "<br>";
            echo $datetime->format('Y-m-d H:i:s');

        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function sync()
    {

        self::last30Mins(date('Y-m-d H:i:s'));
        die();

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $attendanceRows = [];
            $devices = Device::find()->where(['status' => Constant::DEVICE_ACTIVE])->orderBy('isPrimary DESC')->all();
            foreach ($devices as $device) {
                if (!empty($device->deviceModel)) {
                    $zk = new ZKTeco($device->ip, $device->port, 5); //New Device
                    $zk->connect();
                    $attendances = $zk->getAttendance($device->deviceModel);
                    foreach ($attendances as $attendance) {
                        if(self::isToday(date('Y-m-d'), $attendance['timestamp'])){
                            $attendanceRows[] = [
                                'id' => null,
                                'uuid' => Uuid::uuid1()->toString(),
                                'userId' => (int)$attendance['id'],
                                'state' => (string)$attendance['state'],
                                'deviceId' => (int)$device->id,
                                'companyId' => (int)$device->companyId,
                                'locationId' => (int)$device->locationId,
                                'deviceTime' => $attendance['timestamp'],
                                'isSync' => 0,
                            ];
                        }
                    }
                }
            }


            $command = Yii::$app->db->createCommand()->batchInsert(Attendance::tableName(),
                ['id', 'uuid', 'userId', 'state', 'deviceId', 'companyId', 'locationId', 'deviceTime', 'isSync'], $attendanceRows);
            $command->setRawSql($command->getRawSql() . ' ON DUPLICATE KEY UPDATE userId=userId');
            $command->execute();

            return $transaction->commit();


        } catch
        (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

}