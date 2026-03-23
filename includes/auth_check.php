<?php

if (!isset($_SESSION['user_id']))
{
    header("Location: /alumni_v2/modules/auth/login.php");
    exit();
}

?>