<?php

namespace Ourted\Model\Message;

use Ourted\Bot;
use Ourted\Model\Channel\Channel;

class Embed
{


    protected $bot;
    protected $token;
    private $embed = [];
    private $fields = [];
    private $fields_arr = [];


    /**
     * @param $title
     * @param Bot $bot
     * @param Channel $channel
     * @param string $description
     */
    public function __construct($title, $bot, $channel, $description = "")
    {
        $this->embed['title'] = $title;
        $this->embed['description'] = $description;
        $this->embed['channel_id'] = $channel->id;
        $this->bot = $bot->getBot();
        $this->token = $bot->getToken();
    }


    /**
     * @var array $field Fields In Array
     *
     */

    public function add_field(array ...$field)
    {
        if(isset($field[0][0])){
            $this->fields[] = $field;
        }else{
            $this->fields_arr[] = $field;
        }

    }

    /**
     * Get added fields
     *
     * @return string
     */
    private function get_fields()
    {
        $data = "";
        if (!isset($this->fields[0][0][0])){
            if(!isset($this->fields_arr[0])){
                return "";
            }
            foreach ($this->fields_arr[0] as $key => $item) {
                $toplam_field = count($this->fields_arr);
                $data .= $toplam_field == $key ?
                    // If
                    "{\"name\":\"{$item["name"]}\",\"value\":\"{$item["value"]}\"}" :
                    // If Not
                    "{\"name\":\"{$item["name"]}\",\"value\":\"{$item["value"]}\"},";
            }
        }else {
            foreach ($this->fields[0][0] as $key => $item) {
                $toplam_field = count($this->fields[0][0][0]);
                $data .= $toplam_field - 1 == $key ?
                    // If
                    "{\"name\":\"{$item["name"]}\",\"value\":\"{$item["value"]}\"}" :
                    // If Not
                    "{\"name\":\"{$item["name"]}\",\"value\":\"{$item["value"]}\"},";
            }
        }
        return $data;
    }

    public
    function send_embed()
    {
        $field = "{
  \"content\": \"\",
  \"tts\": false,
  \"embed\": {
    \"title\": \"{$this->embed['title']}\",
    " . ($this->embed['description'] != "" ?
                "\"description\": \"{$this->embed['description']}\"," : null) .
            "\"type\":\"rich\",
   \"fields\": [" . $this->get_fields() . "]
  }
}";
        $this->bot->api->init_curl_with_header(
            "channels/{$this->embed['channel_id']}/messages",
             $field, "POST");
    }
}