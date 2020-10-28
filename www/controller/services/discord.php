<?php
namespace controller\services;
class discord {

   public static function auth_redirect($client_id, $scopes) {
      print '<form id="authorize" method="GET" action="https://discordapp.com/api/oauth2/authorize">
                    <input type="hidden" name="response_type" value="code"/>
                    <input type="hidden" name="client_id" value="'.$client_id.'"/>
                    <input type="hidden" name="scope" value="'.$scopes.'"/>
                    <div class="spinner-border"></div>
             </form>
             ';

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
      ), false);
      return ($request['status'] === 200 ? json_decode($request['data'], true) : false);
   }


}
