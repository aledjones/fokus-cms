<?php
if($user->r('str', 'struk') && $index == 'n102')
{
    if($v->task == 'activate_1')
    {
        $updtA = $fksdb->query("UPDATE ".SQLPRE."structures SET a1 = '0'");
        $updtB = $fksdb->query("UPDATE ".SQLPRE."structures SET a1 = '1' WHERE id = '".$v->id."' LIMIT 1");
    }
    elseif($v->task == 'activate_2')
    {
        $updtA = $fksdb->query("UPDATE ".SQLPRE."structures SET a2 = '0'");
        $updtB = $fksdb->query("UPDATE ".SQLPRE."structures SET a2 = '1' WHERE id = '".$v->id."' LIMIT 1");
    }
    elseif($v->task == 'del')
    {
        $sele = $fksdb->fetch("SELECT id, a1, a2 FROM ".SQLPRE."structures WHERE id = '".$v->id."' LIMIT 1");
        
        $updt = $fksdb->query("UPDATE ".SQLPRE."structures SET papierkorb = '1', a1 = '0', a2 = '0' WHERE id = '".$v->id."' LIMIT 1");
        $user->trash('struktur', $v->id);
        
        if($sele->a1)
            $updtB = $fksdb->query("UPDATE ".SQLPRE."structures SET a1 = '1' WHERE papierkorb = '0' ORDER BY id DESC LIMIT 1");
        if($sele->a2)
            $updtB = $fksdb->query("UPDATE ".SQLPRE."structures SET a2 = '1' WHERE papierkorb = '0' ORDER BY id DESC LIMIT 1");
    }
}
?>                                          