<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bot
{
    private $telb_url;

    public function __construct($token = NULL)
    {
        $this->CI = &get_instance();
        $this->telb_url = 'https://api.telegram.org/bot' . $token . '/';
    }

   /** json post to call back url from telegram 
    *
    * @return AString response 
    */
    public function telegram_callback()
    {
        $update = file_get_contents('php://input');
        $call = json_decode($update, TRUE);

        $chatId = $call["message"]["chat"]["id"];
        $message = $call["message"]["text"];

        $phone = '';
        if (preg_match("/phone/", $message)) {
            $phone = preg_replace("/\\/phone\//", "$1", $message);
            $message = "/phone/";
        }

        switch (strtolower($message)) {
            case '/start':
                return $this->send_message($chatId, 'hi! ,I Can help you with the following services /bulksms  /quotes /contacts ');
                break;

            case '/quotes':
                return  $this->send_message($chatId, '');
                break;

            case 'contacts':
            case '/contacts':
                return  $this->send_message($chatId, 'Contacts us on  info@domain ');
                break;
            default:
                return $this->send_message($chatId, "Sorry ,I didn't understand what you meant am still learning Type /help");
        }
    }

    public function send_message($chatId, $message)
    {
        return $this->query($this->telb_url . 'sendMessage?chat_id=' . $chatId . '&text=' . $message);
    }

   /** register call back url
    * @return void
    */
    public function webhook($command, $domain = NULL)
    {
        switch ($command) {
            case 'set':
                return $this->query($this->telb_url . 'setWebhook?url=' . $domain);
                break;

            case 'delete':
                return $this->query($this->telb_url . 'deleteWebhook');
                break;

            case 'info':
                return $this->query($this->telb_url . 'getWebhookInfo');
                break;
        }
    }

    public function query($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $curl_response = curl_exec($curl);
        if ($curl_response == true) {
            return $curl_response;
        } else {
            return curl_error($curl);
        }
    }
}
