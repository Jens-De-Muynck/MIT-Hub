<?php
    $file = fopen('chat.json','w');
    $data = $_POST['data'];
    fwrite($file,$data);
    fclose($file);
    echo $data;
?>