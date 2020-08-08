<?php

namespace Ourted\Model\EventListener;

use Ourted\Bot;

abstract class EventListener
{
    /**
     * Bot
     *
     * @var Bot $bot
     */
    public $bot;


    /**
     * Bot Token
     *
     * @var string $token
     */
    public $token;

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     *
     * @var Bot $bot
     */
    public function __construct($bot)
    {
        $this->bot = $bot;
        $this->token = $bot->getToken();
        $bot->addDispatch('GUILD_CREATE',$this->generateRandomString(), function ($json) {
            $this->onGuildJoin($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_MEMBER_ADD',$this->generateRandomString(), function ($json) {
            $this->onGuildMemberAdd($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_MEMBER_UPDATE',$this->generateRandomString(), function ($json) {
            $this->onGuildMemberUpdate($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_MEMBER_DELETE',$this->generateRandomString(), function ($json) {
            $this->onGuildMemberDelete($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_UPDATE',$this->generateRandomString(), function ($json) {
            $this->onGuildDelete($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_DELETE',$this->generateRandomString(), function ($json) {
            $this->onGuildUpdate($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_ROLE_CREATE',$this->generateRandomString(), function ($json) {
            $this->onGuildRoleCreate($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_ROLE_UPDATE',$this->generateRandomString(), function ($json) {
            $this->onGuildRoleUpdate($json->d, $this->bot);
        });
        $bot->addDispatch('GUILD_ROLE_DELETE',$this->generateRandomString(), function ($json) {
            $this->onGuildRoleDelete($json->d, $this->bot);
        });
        $bot->addDispatch('MESSAGE_CREATE',$this->generateRandomString(), function ($json) {
            $this->onMessageCreate($json->d, $this->bot);
        });
        $bot->addDispatch('CHANNEL_CREATE',$this->generateRandomString(), function ($json) {
            $this->onChannelCreate($json->d, $this->bot);
        });
        $bot->addDispatch('CHANNEL_UPDATE',$this->generateRandomString(), function ($json) {
            $this->onChannelUpdate($json->d, $this->bot);
        });
        $bot->addDispatch('CHANNEL_DELETE',$this->generateRandomString(), function ($json) {
            $this->onChannelDelete($json->d, $this->bot);
        });
        $bot->addDispatch('CHANNEL_PINS_UPDATE',$this->generateRandomString(), function ($json) {
            $this->onChannelPinsUpdate($json->d, $this->bot);
        });

        $bot->addDispatch('READY',$this->generateRandomString(), function ($json) {
            $this->onReady($json->d, $this->bot);
        });
    }

    # Guild
    public function onGuildJoin($json, $bot)
    {

    }

    public function onGuildUpdate($json, $bot)
    {

    }

    public function onGuildDelete($json, $bot)
    {

    }

    # Member
    public function onGuildMemberAdd($json, $bot)
    {

    }

    public function onGuildMemberUpdate($json, $bot)
    {

    }

    public function onGuildMemberDelete($json, $bot)
    {

    }

    # Channel
    public function onChannelCreate($json, $bot)
    {

    }

    public function onChannelUpdate($json, $bot)
    {

    }

    public function onChannelDelete($json, $bot)
    {

    }

    public function onChannelPinsUpdate($json, $bot)
    {

    }






    # Role
    public function onGuildRoleCreate($json, $bot)
    {

    }

    public function onGuildRoleUpdate($json, $bot)
    {

    }

    public function onGuildRoleDelete($json, $bot)
    {

    }


    # Message
    public function onMessageCreate($json, $bot)
    {

    }


    # Bot
    public function onReady($json, $bot)
    {

    }


}
