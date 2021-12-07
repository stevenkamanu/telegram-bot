# telegram-bot
PHP Telgram bot library

## uses
  <?php
    require_once('api.php');
    $bot = new Api("TELEGRAM BOT API KEY");

    //place on your callback url you registered
    $bot->telegram_callback();

    //run once
    $bot->webhook('set','url callback ');

     //run once url delete
    $bot->webhook('delete');

    //run once url delete
    $bot->webhook('info');

  
