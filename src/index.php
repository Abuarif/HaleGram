<html>
<meta charset="utf-8">
<meta name="theme-color" content="#009688">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<body bgcolor="#ACE1AF">
<?php
require "class-http-request.php";
echo "<br>";
$anno = date("Y");
echo '<center><img src="HaleGram.png" alt="Logo di HaleGram" height="150" width="200"></center>';
echo "<br><center><h1><b>HaleGram</b> | $anno</h1></center>";
class Bot
{
    
    public function __construct($api)
    {
        if (!empty($api)) {
            $this->API = $api;
            echo "<br><center>\r\n<b>Initializing a new session..</b></center>";
        } else {
            echo "<br><center>\r\n<b>Error!</b> API Key is empty!</center>";
            #exit;
        }
    }
    
    public function getMe()
    {
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/getme");
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            echo "<br><center>\r\n<b>Error!</b> <i>Method: getMe</i></center>";
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function getWebhookInfo()
    {
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/getWebhookInfo");
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            echo "<br><center>\r\n<b>Error!</b> <i>Method: getWebhookInfo</i></center>";
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function getUpdates($offset, $limit, $timeout, $allowed)
    {
        if ($offset)
            $data['offset'] = $offset;
        if ($limit)
            $data['limit'] = $limit;
        if ($timeout)
            $data['timeout'] = $timeout;
        if ($allowed)
            $data['allowed_updates'] = $allowed;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/getUpdates", $data);
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: getUpdates</i></center>";
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function sendMessage($chatID, $text, $rmf = false, $pm = 'HTML', $dis = false, $replyto = false, $inline = 'pred')
    {
        
        if ($rmf == "nascondi")
            $inline = false;
        if (!$inline) {
            if ($rmf == 'nascondi') {
                $rm = array(
                    'hide_keyboard' => true
                );
            } else {
                $rm = array(
                    'keyboard' => $rmf,
                    'resize_keyboard' => true
                );
            }
        } else {
            $rm = array(
                'inline_keyboard' => $rmf
            );
        }
        $rm = json_encode($rm);
        
        $args = array(
            'chat_id' => $chatID,
            'text' => $text,
            'disable_notification' => $dis,
            'parse_mode' => $pm
        );
        if ($dal)
            $args['disable_web_page_preview'] = $dal;
        if ($replyto)
            $args['reply_to_message_id'] = $replyto;
        if ($rmf)
            $args['reply_markup'] = $rm;
        if ($text) {
            $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendMessage", $args);
            $rr        = $r->getResponse();
            $rrr       = json_decode($rr, true);
            $risultato = $rrr['ok'];
            if ($risultato == true) {
                return $rr;
            } else {
                echo "<br>\r\n<center><b>Error!</b> <i>Method: sendMessage</i></center>";
                return $rr;
            }
        }
    }
    public function editMessageText($chatID, $ntext, $cbmid, $npm = "HTML", $nmenu = false)
    {
        if ($cbmid) {
            if ($nmenu) {
                $rm = array(
                    'inline_keyboard' => $nmenu
                );
                $rm = json_encode($rm);
            }
            $args = array(
                'chat_id' => $chatID,
                'message_id' => $cbmid,
                'text' => $ntext,
                'parse_mode' => $npm
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
            $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/editMessageText", $args);
            $rr        = $r->getResponse();
            $rrr       = json_decode($rr, true);
            $risultato = $rrr['ok'];
            if ($risultato == true) {
                return $rr;
            } else {
                echo "<br>\r\n<center><b>Error!</b> <i>Method: editMessageText</i></center>";
                return $rr;
            }
        } else {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: editMessageText</i></center>";
        }
    }
    public function forwardMessage($chatID, $fromchat, $msgid, $dis = false)
    {
        $args      = array(
            'chat_id' => $chatID,
            'from_chat_id' => $fromchat,
            'message_id' => $msgid,
            'disable_notification' => $dis
        );
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/forwardMessage", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: forwardMessage</i></center>";
            return $rr;
        }
    }
    public function sendChatAction($chatID, $type = "typing")
    {
        $args      = array(
            'chat_id' => $chatID,
            'action' => $type
        );
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendChatAction", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: sendChatAction</i></center>";
            return $rr;
        }
    }
    public function sendPhoto($chatID, $img, $rmf = false, $cap = '', $inline = false)
    {
        
        if ($rmf) {
            if ($inline) {
                $rm = array(
                    'inline_keyboard' => $rmf
                );
                $rm = json_encode($rm);
            } else {
                $rm = array(
                    'keyboard' => $rmf,
                    'resize_keyboard' => true
                );
                $rm = json_encode($rm);
            }
        }
        $args = array(
            'chat_id' => $chatID,
            'photo' => $img,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendPhoto", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: sendPhoto</i></center>";
            return $rr;
        }
    }
    public function sendVideo($chatID, $vid, $rmf = false, $cap = '', $inline = false)
    {
        
        if ($rmf) {
            if ($inline) {
                $rm = array(
                    'inline_keyboard' => $rmf
                );
                $rm = json_encode($rm);
            } else {
                $rm = array(
                    'keyboard' => $rmf,
                    'resize_keyboard' => true
                );
                $rm = json_encode($rm);
            }
        }
        $args = array(
            'chat_id' => $chatID,
            'video' => $vid,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendVideo", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            echo "<br>\r\n<center><b>Error!</b> <i>Method: sendVideo</i></center>";
            return $rr;
        }
    }
}
