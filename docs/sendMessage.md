---
Title: sendMessage
Description: How to use sendMessage
---
## Type: sendMessage
[Back to index](index.md)



### How to use:

```
sendMessage($chatID, $text, $rmf = false, $pm = 'HTML', $dis = false, $replyto = false, $inline = false);
```

* $chatID is the ID where you want to send the message
* $text is the text to send 
* $rmf is the menù that you want to send in array, default is _false_
* $pm is the _parse mode_ and you can choose *HTML* or *Markdown*, default is _HTML_
* $dis is the _disable notification_, default is _false_
* $replyto is the *ID of the message that you want to reply*, default is _false_
* $inline need to be active if you want to send an inline keyboard, is required $rmf, default is _false_

### Examples:

```
$var = new Bot("Token");
$var2 = $var->sendMessage(279131122, "Hello! How are u dev?", false, "Markdown", true, false, false);
```
