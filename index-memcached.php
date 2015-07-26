<?php
$debug = 1;
define('WP_USE_THEMES', true);
$s_uri = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$s_refresh_ff = $_SERVER['HTTP_CACHE_CONTROL'];
$s_refresh_ie = $_SERVER['HTTP_PRAGMA'];
$s_force_refresh = @$_GET['force_reload'];
$mkey = md5($s_uri);

$mCache = new Memcache();;
$mCache->addServer("127.0.0.1", 11211);
$keyExist = $mCache->get($mkey);

if (!empty($keyExist)){
     $html = $keyExist;
   if ($s_refresh_ff || $s_refresh_ie || $s_force_refresh){
        $mCache->delete($mkey);
   }
    else
   {
          $html .= "Powered by Memcached";
   }
  print $html;
}
else {

ob_start();
require('./wp-blog-header.php');
$html = ob_get_contents();
ob_end_clean();

print $html;


 if (!is_user_logged_in() || !is_404() || !is_search() || !stristr($s_uri,'#comment')){

   if ($mCache->set($mkey,$html)){
       $msg = "cache set";
   }
 }
}


?>

