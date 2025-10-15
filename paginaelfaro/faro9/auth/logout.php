<?php
// /faro6/auth/logout.php
session_start();
session_unset();
session_destroy();
header('Location: /faro6/index.php');
exit;
