<?php

namespace app\library\zkteco\Helper;;

use app\library\zkteco\Helper\Util;
use app\library\zkteco\ZKTeco;

class Version
{
    /**
     * @param ZKTeco $self
     * @return bool|mixed
     */
    static public function get(ZKTeco $self)
    {
        $self->_section = __METHOD__;
        $command = Util::CMD_VERSION;
        return $self->_command($command, '');
    }
}