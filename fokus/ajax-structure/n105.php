<?php
if($user->r('str', 'struk') && $index == 'n105')
{
    echo '
    <h1>'.$trans->__('Neue Struktur anlegen.').'</h1>
    
    <div class="box" id="struktur_neu">
        <table>
            <tr>
                <td>'.$trans->__('Name der Struktur:').'</td>
                <td class="b"><input type="text" name="titel" required /></td>
            </tr>
            <tr>
                <td>'.$trans->__('Bestehende Struktur duplizieren:').'</td>
                <td class="b">
                    <select name="clone">
                        <option value=""></option>';
                        $ergebnis2 = $fksdb->query("SELECT id, titel FROM ".SQLPRE."structures WHERE papierkorb = '0' ORDER BY id DESC");
                        while($row2 = $fksdb->fetch($ergebnis2))
                            echo '<option value="'.$row2->id.'">'.$row2->titel.'</option>';
                    echo '
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="box_save">
        <input type="button" value="'.$trans->__('abbrechen').'" class="bs1" /> 
        <input type="button" value="'.$trans->__('speichern').'" class="bs2" />
    </div>'; 
}
?>                                          