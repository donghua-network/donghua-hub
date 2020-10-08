<?php
namespace controller;
class discord {

   public static function auth_redirect($client_id, $scopes) {
      Router::redirect('https://discordapp.com/api/oauth2/authorize?' . http_build_query(array(
         'response_type' => 'code',
         'client_id'     => $client_id,
         'scope'         => $scopes,
      )));
   }

   public static function auth($client_id, $client_secret, $scopes, $code) {
       $request = \model\form::curl('https://discordapp.com/api/oauth2/token',
           'application/x-www-form-urlencoded', http_build_query(array(
         'grant_type'    => 'authorization_code',
         'client_id'     => $client_id,
         'client_secret' => $client_secret,
         'scope'         => $scopes,
         'code'          => $code
      )));
      return ($request['status'] === 200 ? json_decode($request['data'], true) : false);
   }

   public static function user_info($token) {
      $request = \model\form::curl('https://discordapp.com/api/users/@me', array(
         'authorization: Bearer ' . $token
      ), 'auth');
      return ($request['status'] === 200 ? json_decode($request['data'], true) : false);
   }


}
