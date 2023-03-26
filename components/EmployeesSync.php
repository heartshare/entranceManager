<?php

namespace app\components;

use app\library\zkteco\Helper\Util;
use app\library\zkteco\ZKTeco;
use app\models\Device;
use app\models\Employee;
use app\models\EmployeeDeviceRelation;
use Ramsey\Uuid\Nonstandard\Uuid;
use Yii;
use yii\base\Component;

class EmployeesSync extends Component
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

    public static function users()
    {

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $employeeRows = [];
            $employeeDeviceRows = [];
            $device = Device::find()->where(['status'=>Constant::DEVICE_ACTIVE])->orderBy('isPrimary DESC')->all();

            foreach ($device as $device) {
                $zk = new ZKTeco($device->ip, $device->port, 5); //New Device
                $zk->connect();
                $users = $zk->getUser();
                foreach ($users as $user) {
                    $employeeRows[] = [
                        'id' => null,
                        'uuid' => Uuid::uuid1()->toString(),
                        'userId' => (int)$user['userid'],
                        'userUid' => (string)$user['uid'],
                        'role' => (int)$user['role'],
                        'name' => $user['name'],
                        'password' => $user['password'],
                        'cardNo' => $user['cardno'],
                        'status' => 0
                    ];
                    $employeeDeviceRows[] = [
                        'id' => null,
                        'uuid' => Uuid::uuid1()->toString(),
                        'employeeId' => (int)$user['userid'],
                        'deviceId' => $device->id,
                        'finger' => (int)$user['role'],
                    ];
                }
            }

            $command = Yii::$app->db->createCommand()->batchInsert(Employee::tableName(),
                ['id', 'uuid', 'userId', 'userUid', 'role', 'name', 'password', 'cardNo', 'status'], $employeeRows);
            $command->setRawSql($command->getRawSql(). ' ON DUPLICATE KEY UPDATE userId=userId');
            $command->execute();

            $commandRel = Yii::$app->db->createCommand()->batchInsert(EmployeeDeviceRelation::tableName(),
                ['id', 'uuid', 'employeeId', 'deviceId', 'finger'], $employeeDeviceRows);

            $commandRel->setRawSql($commandRel->getRawSql(). ' ON DUPLICATE KEY UPDATE employeeId=employeeId');
            $commandRel->execute();

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

    public static function finger()
    {
        $device = Device::findOne(['isPrimary' =>1]);
        if($device){
            $zk = new ZKTeco($device->ip, $device->port, 5); //New Device
            if($zk->connect()){
                $employees = Employee::find()->where(['finger' =>null])->limit(10)->orderBy('userId')->all();
                foreach ($employees as $employee){
                    var_dump($zk->getFingerprint($employee->userUid));
                    $employee->finger = $zk->getFingerprint($employee->userUid);
                    if(!$employee->save()){
                        dd($employee->getErrors());
                        die();
                    }
                }
            }
        }
    }

}