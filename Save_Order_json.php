<?php
    $fp = fopen('orders.json', 'a');
    fwrite($fp, json_encode($_POST['neworder']));
    fclose($fp);

