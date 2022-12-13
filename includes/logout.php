<?php

    include_once '../includes/user_session.php';

    $ipSession = new IpSession();
    $ipSession->closeSession();

    header("location: ../index.php");

?>