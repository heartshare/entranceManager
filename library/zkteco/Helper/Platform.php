<?php

namespace app\library\zkteco\Helper;

use app\library\zkteco\ZKTeco;

class Platform
{
    /**
     * @param ZKTeco $self
     * @return bool|mixed
     */
    static public function get(ZKTeco $self)
    {
        $self->_section = __METHOD__;

        $command = Util::CMD_DEVICE;
        $command_string = '~Platform';
        $command = $self->_command($command, $command_string);
        $pos = strpos($command, $command_string);
        if ($pos !== false) { return substr($command, 10);}
        return false;
    }

    /**
     * @param ZKTeco $self
     * @return bool|mixed
     */
    static public function getVersion(ZKTeco $self)
    {
        $self->_section = __METHOD__;

        $command = Util::CMD_DEVICE;
        $command_string = '~ZKFPVersion';
        $command = $self->_command($command, $command_string);
        $pos = strpos($command, $command_string);
        if ($pos !== false) { return 'ZKFPV.'.substr($command, 13);}
        return false;
    }
}