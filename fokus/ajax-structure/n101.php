<?php
if($user->r('str', 'struk') && $index == 'n101')
{
    $struksQ = $fksdb->query("SELECT id, a1, a2, titel FROM ".SQLPRE."structures WHERE papierkorb = '0' ORDER BY id DESC");
    while($struk = $fksdb->fetch($struksQ))
    {
        echo '
        <tr>
            <td class="a">
                '.($struk->a2?'<a class="goto">'.$struk->titel.'</a>':$struk->titel).'
            </td>
            <td>
                '.($struk->a1?'<img src="images/yes.png" alt="Ja" />':'<a class="opt" data-task="activate_1" data-id="'.$struk->id.'"><img src="images/no.png" alt="Nein" /></a>').'
            </td>
            <td>
            '.($struk->a2?'<img src="images/yes.png" alt="Ja" />':'<a class="opt" data-task="activate_2" data-id="'.$struk->id.'"><img src="images/no.png" alt="Nein" /></a>').'
            </td>
            <td class="d">
                '.($struk->a1 || $struk->a2?
                    $trans->__('Struktur aktiv')
                    :
                    '<a class="opt" data-task="del" data-id="'.$struk->id.'">'.$trans->__('Struktur löschen').'</a>'
                ).'
            </td>
        </tr>';
    }
}
?>                                          