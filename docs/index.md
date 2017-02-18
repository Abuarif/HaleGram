---
title: HaleGram's docs
description: PHP framework of bot telegram's api
---
# HaleGram

Created by [GynxLol](https://telegram.me/GynxLol), licensed under MIT.
*HaleGram is the best framework to create a bot for Telegram!*

This framework make use of another class:

* [Http Request](https://github.com/hay/httprequest/blob/master/class-http-request.php)

<img src='https://raw.githubusercontent.com/GynxLol/HaleGram/master/src/HaleGram.png' alt='HaleGram logo' onmouseover="this.src='https://raw.githubusercontent.com/GynxLol/HaleGram/master/src/HaleGram.png';" onmouseout="this.src='https://raw.githubusercontent.com/GynxLol/HaleGram/master/src/HaleGram.png';" />

##Usage

###Installation

To install this framework you must have on your server:

* [Php](https://php.net)
* [Curl for Php](http://php.net/manual/en/book.curl.php)

_And you can do everything!_

```
git clone https://github.com/GynxLol/HaleGram
```

##Examples

For example you can view _example.php_ that you can see what can you do with @HaleGram!
It's so simple!

```
$var = new Bot("Token");
$var2 = $var->Method
```

You can check the methods on [Telegram's bot API](http://core.telegram.org/bots/api)
For now there is these methods:

```
getMe
getUpdates
getWebhookInfo
sendMessage
sendChatAction (is typing...)
sendPhoto
sendVideo
editMessageText
forwardMessage
sendAudio
sendVoice
sendDocument
sendSticker
sendLocation
sendContact
sendVenue
getFile
getChat
getChatAdministrators
getChatMembersCount
getChatMember
getUserProfilePhotos
kickChatMember
unbanChatMember
leaveChat
unbanChatMember
editMessageCaption
editMessageReplyMarkup
```

and other in updates..! Listen to [@HaleGram](https://telegram.me/HaleGram)

##Thanks to
I would like to thank [@DanoGentili](https://telegram.me/DanoGentili), the PWRTelegram & MadelineProto's creator, [@BruninoIt](https://telegram.me/BruninoIt) and every my supporters that believe in me! Thank you guys <3
