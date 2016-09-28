<?php


require_once 'includes/html_dom_class.php';
require_once 'includes/log_class.php';
require_once 'includes/db_class.php';
require_once 'includes/facebook/facebook.php';
require_once 'includes/wiziwig_class.php';
require_once 'includes/eurorivals_class.php';
require_once 'includes/chat_class.php';
require_once 'includes/functions.php';
require_once 'includes/register_class.php';

require_once 'includes/LiveTvRu_Class.php';

$cfg['db']['server'] = 'localhost';
$cfg['db']['user'] = 'root';
$cfg['db']['pass'] = '';
$cfg['db']['name'] = 'streams4u';

$cfg['logger']['datetime_format'] = 'd.m.Y H:i';
$cfg['logger']['logs_dir'] = 'logs';

$db = new db();
$db->connect();

$register = new register();
$chat = new chat();

$matchs = new Wiziwig();
$Stream = new Wiziwig_Streams();

$Highlights = new Eurorivals();

$LiveTvRu = new LiveTvRu();


$facebook = new Facebook(array(
  'appId'  => '637419776271896',
  'secret' => 'e8cd47329ad822c3977a91b5f042bd7d',
));

$params = array(
          'scope' => 'email, read_stream',
          'redirect_uri' => 'http://streams4u.pl/index.php?act=fbregister'
        );
        
$loginUrl = $facebook->getLoginUrl($params);

?>