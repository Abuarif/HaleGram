<?php
require "index.php";
//Examples
$token = "YourToken";
$variable = new Bot($token);
$variable2 = $variable->sendMessage("ID", "Hello!");
