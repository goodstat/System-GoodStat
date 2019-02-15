<?php
session_start();
//$_SESSION = array();
session_destroy();
unset($_SESSION['sesja_uzyt']);
unset($_SESSION['sesja_uzyt']['zalogowany']);
unset($_SESSION['sesja_uzyt']['id_loginu']);

header("Location: index.php"); // ucieka do strony
?>