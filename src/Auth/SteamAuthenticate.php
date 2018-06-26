<?php
namespace Cake\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use LightOpenID;
use Cake\Core\Configure;

class SteamAuthenticate extends BaseAuthenticate
{
	const STEAM_URL = 'http://steamcommunity.com/openid/';
	
    public function authenticate(ServerRequest $request, Response $response)
    {
        $openID = new LightOpenID(Configure::readOrFail('Steam.redirectUrl'));

        if ($openID->mode) {
            return $this->checkMode($openID);
        } 
		
        $openID->identity = self::STEAM_URL;
        header('Location: ' . $openID->authUrl());
    }

    private function checkMode(LightOpenID $openID)
    {
        if ($openID->validate()) {
            $getID = explode('/',$openID->__get('identity'));
            return end($getID);
        }
		
        $openID->identity = self::STEAM_URL;
        header('Location: ' . $openID->authUrl());
    }
}
