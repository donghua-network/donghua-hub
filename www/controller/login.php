<?php
$user = new \model\user();
print_r(array($user->curl('https://discord.com/api/oauth2/authorize?client_id=268616600402264066&redirect_uri=http%3A%2F%2Flocalhost%3A8090&grant_type=authorization_code&scope=identify&client_secret=OnU8p14L13-pdyrBgxxqcTDqiZdSpjWx', "x-www-form-urlencoded")));
?>
