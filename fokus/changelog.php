<?php
define('IS_BACKEND', true, true);

require_once('../inc/header.php');
require_once('login.php');

echo '
<h1>CMS fokus Version '.$base->getOpt('changelog').' wurde installiert.</h2>

<div class="box">
    <h2 class="calibri">Was ist neu?</h2>
    
    <ul>
        <li><strong>Neu in 2013.30</strong></li>
        <li>Quellcode-Qualität gesteigert</li>
        <li>Mehrere Bugs behoben</li>
    </ul>
</div>

<div class="box_save">
    <button class="bs2">weiter</button>
</div>';

$upd = $fksdb->query("UPDATE ".SQLPRE."options SET changelog = '' WHERE id = '1' LIMIT 1");
?>