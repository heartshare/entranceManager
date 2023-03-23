<?php

namespace app\library\zkteco\Helper;

use app\library\zkteco\ZKTeco;

class SerialNumber
{
    /**
     * @param ZKTeco $self
     * @return bool|mixed
     */
    static public function get(ZKTeco $self)
    {
        $self->_section = __METHOD__;

        $command = Util::CMD_DEVICE;
        $command_string = '~SerialNumber';
        $command =$self->_command($command, $command_string);
        $pos = strpos($command, $command_string);
        if ($pos !== false) { return substr($command, 14);}
        return false;
    }
}