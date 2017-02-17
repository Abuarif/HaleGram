<?php
require "index.php";
//Examples
/* REMEMBER:
** When you create a new session don't use the "bot" at the API Key/Token's start!
** Every methods are called with the same name in API Docs!
Thank you! And then you can see examples :) 
*/

# $token = "Token of your bot without "bot" at the start";
# $id = "ID that receive message";
# $text = "Text to send!";

$token = "123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11";
$id = "279131122";
$text = "Hello! I'm working!";

$variable = new Bot($token);
$variable2 = $variable->sendMessage($id, $text);
