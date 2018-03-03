<?php

include 'config_helper.php';

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
