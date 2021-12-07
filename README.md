# telegram-bot
PHP Telgram bot library

## uses
     <?php
     require_once('api.php');
     $bot = new Api("TELEGRAM BOT API KEY");

     //place on your callback url you registered
     $bot->telegram_callback();

     //run once
     //return json data {"ok":true,"result":true,"description":"Webhook was set"}
     $bot->webhook('set','url callback ');

     //run once url delete
     //return {"ok":true,"result":true,"description":"Webhook was deleted"}
      $bot->webhook('delete');

     //run once url delete
     //return json data  {"ok":true,"result":    {"url":"set domain callback url","has_custom_certificate":false,"pending_update_count":0,"max_connections":40,"ip_address":"127.0.0.1"}}
     $bot->webhook('info');]
     

  
