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
echo "<center>";
class Bot
{
    
    public function __construct($api)
    {
        if (!empty($api)) {
            $this->API = $api;
            echo "<br><center>\r\n<b>Initializing a new session..</b></center>";
        } else {
            $error = "<br><center>\r\n<b>Error!</b> API Key is empty!</center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . "\n\n");
            fclose($f2);
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
            $error = "<br><center>\r\n<b>Error!</b> <i>Method: getMe</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $richiesta . "\n\n");
            fclose($f2);
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
            $error = "<br><center>\r\n<b>Error!</b> <i>Method: getWebhookInfo</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $richiesta . "\n\n");
            fclose($f2);
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function setWebhook($url)
    {
        $version   = phpversion();
        $args      = array(
            'url' => $url
        );
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/setWebhook", $args);
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            $error = "<br><center>\r\n<b>Error!</b> <i>Method: setWebhook</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $richiesta . "\n\n");
            fclose($f2);
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function deleteWebhook()
    {
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/deleteWebhook");
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            $error = "<br><center>\r\n<b>Error!</b> <i>Method: deleteWebhook</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $richiesta . "\n\n");
            fclose($f2);
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function getUpdates($offset = false, $limit = false, $timeout = false, $allowed = false)
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
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getUpdates</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $richiesta . "\n\n");
            fclose($f2);
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function sendMessage($chatID, $text, $rmf = false, $pm = 'HTML', $dis = false, $replyto = false, $inline = false)
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
                $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendMessage</i></center>";
                $error = strip_tags($error);
                $f2    = fopen("error.log", 'a');
                fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
                fclose($f2);
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
                $error = "<br>\r\n<center><b>Error!</b> <i>Method: editMessageText</i></center>";
                $error = strip_tags($error);
                $f2    = fopen("error.log", 'a');
                fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
                fclose($f2);
                return $rr;
            }
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: editMessageText</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, $error . "\n\n");
            fclose($f2);
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
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: forwardMessage</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
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
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendChatAction</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
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
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendPhoto</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendSticker($chatID, $img, $rmf = false, $cap = '', $inline = false)
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
            'sticker' => $img,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendSticker", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendSticker</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
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
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendVideo</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendAudio($chatID, $vid, $rmf = false, $cap = '', $inline = false)
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
            'audio' => $vid,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendAudio", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendAudio</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendDocument($chatID, $vid, $rmf = false, $cap = '', $inline = false)
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
            'document' => $vid,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendDocument", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendDocument</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendVoice($chatID, $vid, $rmf = false, $cap = '', $inline = false)
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
            'voice' => $vid,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendVoice", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendVoice</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendLocation($chatID, $latitude, $longitude, $rmf = false, $cap = '', $inline = false)
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
            'latitude' => $latitude,
            'longitude' => $longitude,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendLocation", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendLocation</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendVenue($chatID, $latitude, $longitude, $title, $address, $rmf = false, $cap = '', $inline = false)
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
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            'caption' => $cap
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendVenue", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendVenue</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendContact($chatID, $phone, $first, $last = false, $rmf = false, $cap = '', $inline = false)
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
            'phone_number' => $phone,
            'first_name' => $first
        );
        if ($rmf)
            $args['reply_markup'] = $rm;
        if ($last)
            $args['last_name'] = $last;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendContact", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendContact</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function kickChatMember($chatID, $userID)
    {
        $args = array(
            'chat_id' => $chatID,
            'user_id' => $userID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/kickChatMember", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: kickChatMember</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function unbanChatMember($chatID, $userID)
    {
        $args = array(
            'chat_id' => $chatID,
            'user_id' => $userID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/unbanChatMember", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: unbanChatMember</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function leaveChat($chatID)
    {
        $args = array(
            'chat_id' => $chatID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/leaveChat", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: leaveChat</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getChat($chatID)
    {
        $args = array(
            'chat_id' => $chatID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/getChat", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getChat</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getChatAdministrators($chatID)
    {
        $args = array(
            'chat_id' => $chatID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/getChatAdministrators", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getChatAdministrators</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getChatMembersCount($chatID)
    {
        $args = array(
            'chat_id' => $chatID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/getChatMembersCount", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getChatMembersCount</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getChatMember($chatID, $userID)
    {
        $args = array(
            'chat_id' => $chatID,
            'user_id' => $userID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/getChatMember", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getChatMember</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getFile($fileID)
    {
        $args = array(
            'file_id' => $fileID
        );
        $r    = new HttpRequest("post", "https://api.telegram.or/bot" . $this->API . "/getFile", $args);
        $rr   = $r->getResponse();
        $rrr  = json_decode($rr, true);
        $risultato == $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getFile</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getUserProfilePhotos($userID, $offset = false, $limit = false)
    {
        $data = array(
            'user_id' => $fileID
        );
        if ($offset)
            $data['offset'] = $offset;
        if ($limit)
            $data['limit'] = $limit;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/getUserProfilePhotos", $data);
        $richiesta = $r->getResponse();
        $rr        = json_decode($richiesta, true);
        $risultato = $rr['ok'];
        if ($risultato == false) {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getUserProfilePhotos</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $richiesta;
        } else {
            return $richiesta;
        }
    }
    
    public function editMessageCaption($caption, $id, $chatID = false, $rm = false)
    {
        if ($id and $chatID) {
            if ($nmenu) {
                $rm = array(
                    'inline_keyboard' => $nmenu
                );
                $rm = json_encode($rm);
            }
            $args = array(
                'chat_id' => $chatID,
                'caption' => $caption,
                'message_id' => $id
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
        } else {
            if ($nmenu) {
                $rm = array(
                    'inline_keyboard' => $nmenu
                );
                $rm = json_encode($rm);
            }
            $args = array(
                'caption' => $caption,
                'inline_message_id' => $id
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
        }
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/editMessageCaption", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: editMessageCaption</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function editMessageReplyMarkup($id, $chatID = false, $rm)
    {
        if ($id and $chatID) {
            if ($nmenu) {
                $rm = array(
                    'inline_keyboard' => $nmenu
                );
                $rm = json_encode($rm);
            }
            $args = array(
                'chat_id' => $chatID,
                'message_id' => $id
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
        } else {
            if ($nmenu) {
                $rm = array(
                    'inline_keyboard' => $nmenu
                );
                $rm = json_encode($rm);
            }
            $args = array(
                'inline_message_id' => $id
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
        }
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/editMessageReplyMarkup", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: editMessageReplyMarkup</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function answerCallbackQuery($text, $id, $alert = false, $cache = 0)
    {
        $args = array(
            'callback_query_id' => $id,
            'cache_time' => $cache,
            'text' => $text
        );
        if ($alert)
            $args["show_alert"] = true;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/answerCallbackQuery", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: answerCallbackQuery</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function answerInlineQuery($text, $id, $switch = false, $switchpm = false, $cache = 5)
    {
        $args = array(
            'inline_query_id' => $id,
            'results' => $text,
            'cache_time' => $cache
        );
        if ($switch and $switchpm) {
            $args["switch_pm_text"]      = $switch;
            $args["switch_pm_parameter"] = $switchpm;
        }
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/answerInlineQuery", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: answerInlineQuery</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function sendGame($chatID, $text, $rmf = false, $dis = false, $replyto = false, $inline = false)
    {
        
        if (!$inline) {
            $rm = array(
                'keyboard' => $rmf,
                'resize_keyboard' => true
            );
        } else {
            $rm = array(
                'inline_keyboard' => $rmf
            );
        }
        $rm = json_encode($rm);
        
        $args = array(
            'chat_id' => $chatID,
            'game_short_name' => $text,
            'disable_notification' => $dis
        );
        if ($replyto)
            $args['reply_to_message_id'] = $replyto;
        if ($rmf)
            $args['reply_markup'] = $rm;
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/sendGame", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: sendGame</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function setGameScore($score, $chatID = false, $userID, $id, $force = false, $dis = false)
    {
        
        if ($id and $chatID) {
            $args = array(
                'user_id' => $userID,
                'score' => $score,
                'force' => $force,
                'disable_edit_message' => $dis,
                'chat_id' => $chatID,
                'message_id' => $cbmid
            );
        } else {
            $args = array(
                'user_id' => $userID,
                'score' => $score,
                'force' => $force,
                'disable_edit_message' => $dis,
                'inline_message_id' => $cbmid
            );
        }
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/setGameScore", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: setGameScore</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function getGameHighScores($userID, $id, $chatID = false, $rm)
    {
        if ($id and $chatID) {
            $args = array(
                'user_id' => $userID,
                'chat_id' => $chatID,
                'message_id' => $id
            );
            if ($nmenu)
                $args["reply_markup"] = $rm;
        } else {
            $args = array(
                'user_id' => $userID,
                'inline_message_id' => $id
            );
        }
        $r         = new HttpRequest("post", "https://api.telegram.org/bot" . $this->API . "/getGameHighScores", $args);
        $rr        = $r->getResponse();
        $rrr       = json_decode($rr, true);
        $risultato = $rrr['ok'];
        if ($risultato == true) {
            return $rr;
        } else {
            $error = "<br>\r\n<center><b>Error!</b> <i>Method: getGameHighScores</i></center>";
            $error = strip_tags($error);
            $f2    = fopen("error.log", 'a');
            fwrite($f2, date("m.d.y") . " " . $error . " " . $rr . "\n\n");
            fclose($f2);
            return $rr;
        }
    }
    
    public function parseMessage($type = "message", $markup = "HTML")
    {
        global $content;
        global $update;
        if (!empty($type)) {
            $msg       = $update[$type]['text'];
            $entities  = $update[$type]['entities'];
            $lengthmsg = strlen($msg);
            $msgi      = $msg;
            $s         = str_split($msgi);
            $i         = false;
            foreach ($entities as $format) {
                $typeformat = $format['type'];
                $offset     = $format['offset'];
                $length     = $format['length'];
                if ($typeformat == "code") {
                    if ($markup == "HTML") {
                        $s[$offset]           = substr_replace($s[$offset], '<code>', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '</code>' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    } else {
                        $s[$offset]           = substr_replace($s[$offset], '`', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '`' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    }
                } elseif ($typeformat == "bold") {
                    if ($markup == "HTML") {
                        $s[$offset]           = substr_replace($s[$offset], '<b>', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '</b>' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    } else {
                        $s[$offset]           = substr_replace($s[$offset], '*', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '*' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    }
                } elseif ($typeformat == "italic") {
                    if ($markup == "HTML") {
                        $s[$offset]           = substr_replace($s[$offset], '<i>', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '</i>' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    } else {
                        $s[$offset]           = substr_replace($s[$offset], '_', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '_' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    }
                } elseif ($typeformat == "pre") {
                    if ($markup == "HTML") {
                        $s[$offset]           = substr_replace($s[$offset], '<pre>', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '</pre>' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    } else {
                        $s[$offset]           = substr_replace($s[$offset], '```', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '```' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    }
                } elseif ($typeformat == "text_link") {
                    $url = $format['url'];
                    if ($markup == "HTML") {
                        $s[$offset]           = substr_replace($s[$offset], '<a href="' . $url . '">', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '</a>' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    } else {
                        $s[$offset]           = substr_replace($s[$offset], '[', strlen($s[$offset]) - 1, 0);
                        $s[$offset + $length] = '](' . $url . ')' . (isset($s[$offset + $length]) ? $s[$offset + $length] : '');
                    }
                }
            }
            $msgi = implode('', $s);
            return $msgi;
        } else {
            return false;
        }
    }
}
