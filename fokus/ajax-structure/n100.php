<?php
if($user->r('str', 'struk') && $index == 'n100')
{
    echo '
    <h1>'.$trans->__('Strukturverwaltung.').'</h1>
    
    <div class="box" id="strukturverwaltung">
        <table>
            <tr class="first">
                <th class="a">'.$trans->__('Name der Struktur').'</th>
                <th>'.$trans->__('Online').'</th>
                <th>'.$trans->__('In Bearbeitung').'</th>
                <th>'.$trans->__('Löschen?').'</th>
            </tr>
            <tr class="loadit">
                <td colspan="4">
                    <img src="images/loading.gif" alt="Bitte warten.. Inhalt wird geladen.." class="ladebalken" />
                </td>
            </tr>
        </table>
        
        <button>'.$trans->__('Neue Struktur anlegen').'</button>
    </div>';
}
?>                                          