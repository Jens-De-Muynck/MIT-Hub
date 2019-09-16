<?php
    /* DISPLAY THE MESSAGES */
    $messages = file_get_contents("chat/chat.json");
    $chat_log = json_decode($messages, true);

    // $chat_data = "<div class='chat-area'>";
    foreach($chat_log as $msg){

        $lc_session_uname = strtolower($_SESSION['username']);
        $lc_chatjson_uname = strtolower($msg['uname']);
        
        if( $lc_session_uname == $lc_chatjson_uname ){
            $class = "own_msg";
            $msg['uname'] = 'You';
        } else { $class = "other_msg"; }

        $chat_data .= "<div class='chat_msg ".$class."'>";
        $chat_data .= "<span class='msg_uname'>".$msg['uname']."</span>";
        $chat_data .= "<p class='msg_text'>".$msg['text']."</p>";
        $chat_data .= "</div>";
    }
    //$chat_data .= "</div>";

    echo $chat_data;
    
?>