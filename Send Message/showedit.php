<?php
/*
  ___                   _         _
 | . \ ___  ___  ___  _| | ___  _| |
 |   // __)/    / . \/ . |/ __)/ . |
 |_\_\\___.\___ \___/\___|\___.\___|
Programmer(); 
@Lock_at_me_now                     
*/
ob_start();
$BOT_KEY = '419282927:AAEIMKKpPFJhRiMXoCkayQjwT44'; /*TOKEN BOT*/
define('API_KEY',$BOT_KEY,0);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
	$res = curl_exec($ch);
if(curl_error($ch)){
	var_dump(curl_error($ch));
}else{
	return json_decode($res);
}
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$name = $message->from->first_name;
$username = $message->from->username;
$editMessage = $update->edited_message;
$chatedit = $update->edited_message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;

if($text == "/start" && $message->chat->type == "private"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MarkDown',
'disable_web_page_preview'=>true,
'text'=>"hello sir [$name](https://t.me/$username) \n •| I'm bot view a *Edit Message in Group* ",
'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  
	 [
	 ['text'=>'Developer', 'url'=>"https://t.me/lock_at_me_now"]
	  ],
        [
		['text'=>'Channel🌐', 'url'=>"https://t.me/babeleon_bot"]
		],
		
]
])
]);
}

if($text == "/start" && $message->chat->type == "supergroup"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'MarkDown',
'disable_web_page_preview'=>true,
'text'=>"hello sir [$name](https://t.me/$username) •| I'm bot view a *Edit Message in Group*  \n *CHAT ID:* *$chat_id* \n Grup type: *" . $message->chat->type . "*",
'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  
	 [
	 ['text'=>'Developer', 'url'=>"https://t.me/lock_at_me_now"]
	  ],
        [
		['text'=>'Channel🌐', 'url'=>"https://t.me/babeleon_bot"]
		],
		
]
])
]);
}

if($editMessage){
	 bot('sendMessage',[
	 'chat_id'=>$chatedit,
	 'text'=>'has Been Edited Message 🚸',
	 'message_id'=>$message->edited_message->message_id,
	 'reply_to_message_id'=>$update->edited_message->message_id,
	 ]);
 }
