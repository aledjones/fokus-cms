<?php
define('IS_BACKEND', true, true);

require_once('../inc/header.php');
require_once('login.php');

$index = $fksdb->save($_REQUEST['index']);
$rel = $fksdb->save($_REQUEST['rel']);

/*//// TYPEN //
dokument
element
firma
personen
rolle
bild
struktur
zsb
*/ ///////////


$load_ajax = 'ajax-last/'.$index.'.php';
if(!file_exists($load_ajax))
    exit('no_file');
require($load_ajax);
?>