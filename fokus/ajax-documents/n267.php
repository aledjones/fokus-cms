<?php
if(!defined('DEPENDENCE'))
    exit('class is dependent');

if(!$user->r('dok') || $index != 'n267')
    exit($user->noRights());

$block = $fksdb->save($_POST['block']);
$ibid = $fksdb->save($_POST['ibid']);
$blockindex = $fksdb->save($_POST['blockindex']);
$id = $fksdb->save($_POST['id'], 1);
$f = ($_POST['f']);
parse_str($f, $fa);

$dokument = $fksdb->fetch("SELECT id, klasse, produkt, dversion_edit, von FROM ".SQLPRE."documents WHERE id = '".$id."' LIMIT 1");
$dve = $fksdb->fetch("SELECT id, klasse_inhalt FROM ".SQLPRE."document_versions WHERE id = '".$dokument->dversion_edit."' LIMIT 1");

if(!$dokument) exit();

if($user->r('dok', 'edit') || ($user->r('dok', 'new') && $dokument->von == $user->getID())) {}
else exit($user->noRights());

if(!$dokument->klasse)
{
    $upt = $fksdb->query("UPDATE ".SQLPRE."blocks SET teaser = '".serialize($fa)."' WHERE id = '".$block."' AND dokument = '".$id."' LIMIT 1");

    $mb = $fksdb->fetch("SELECT vid FROM ".SQLPRE."blocks WHERE id = '".$block."' AND dokument = '".$id."' LIMIT 1");
    if($fa['rss'])
    {
        $rss_check = $fksdb->fetch("SELECT id FROM ".SQLPRE."feeds WHERE block = '".$mb->vid."' AND dokument = '".$id."' LIMIT 1");

        if(!$rss_check)
        {
            $fksdb->insert("feeds", array(
                "block" => $mb->vid,
                "dokument" => $dokument->id,
                "home" => $fa['rss_home'],
                "element" => $fa['element'],
                "titel" => $fa['rss_titel']
            ));
        }
        else
        {
            $updt = $fksdb->query("UPDATE ".SQLPRE."feeds SET home = '".$fa['rss_home']."', element = '".$fa['element']."', titel = '".$fa['rss_titel']."' WHERE id = '".$rss_check->id."' LIMIT 1");
        }
    }
    else
    {
        $del = $fksdb->query("DELETE FROM ".SQLPRE."feeds WHERE block = '".$mb->vid."' AND dokument = '".$id."' LIMIT 1");
    }
}
else
{
    $ki = $base->fixedUnserialize($dve->klasse_inhalt);

    if(!$ibid)
        $ki[$block]['teaser'] = serialize($fa);
    else
        $ki[$ibid]['html'][$blockindex]['teaser'] = serialize($fa);

    $kis = serialize($ki);

    $update = $fksdb->query("UPDATE ".SQLPRE."document_versions SET klasse_inhalt = '".$kis."' WHERE id = '".$dve->id."' LIMIT 1");
}

$d = $fksdb->fetch("SELECT dversion_edit FROM ".SQLPRE."documents WHERE id = '".$id."' LIMIT 1");
$update = $fksdb->query("UPDATE ".SQLPRE."document_versions SET edit = '1', ende = '0', von = '".$user->getID()."', timestamp_edit = '".$base->getTime()."' WHERE id = '".$d->dversion_edit."' LIMIT 1");
$base->create_dk_snippet($id);
?>