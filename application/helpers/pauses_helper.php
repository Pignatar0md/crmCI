<?php
set_time_limit(30);
require "/var/lib/asterisk/agi-bin/phpagi.php";
require_once "/var/lib/asterisk/agi-bin/phpagi-asmanager.php";
define('IP_AMI', '');
define('USER_AMI', '');
define('PASS_AMI', '');
define('IP_MySQL', '');
define('USER_MySQL', '');
define('PASS_MySQL', '');
define('ID_PAUSA', );

function auto_pause($sipext) //********************************** Funcion Auto-Pause
{
     $asm = new AGI_AsteriskManager();
     $res = $asm->connect(IP_AMI, USER_AMI, PASS_AMI);

     if ($res == TRUE) {
        $aResponse = $asm->Originate(
            'Local/098098@queuemetrics/n',
            NULL,NULL,NULL,NULL,
            'auto-pause',
            "AGENTE=" . $sipext,
            NULL,
            'Hangup',
            NULL
        );
    }
}

function auto_unpause($arrData)//********************************** Funcion Auto-Unpause
{
    $asm = new AGI_AsteriskManager();
    $res = $asm->connect(IP_AMI, USER_AMI, PASS_AMI);

    if ($res == TRUE) {
        $resp = $asm->Originate('Local/cambiostatus@queuemetrics','09809899999','queuemetrics','1');
        $aResponse = $asm->Originate(
            'Local/987987@queuemetrics/n',
            NULL,NULL,NULL,NULL,
            'auto-pause',
            "AGENTE=" . $arrData['sipext'],
            NULL,
            'Hangup',
            NULL
        );
    }
}
?>
