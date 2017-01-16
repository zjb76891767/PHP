//判断是否是蜘蛛，如果不是蜘蛛则访问首页


function is_bot() {
  $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']); 
  $spiders = array( 
    'Googlebot', // Google 爬虫 
    'Baiduspider', // 百度爬虫 
    'Yahoo! Slurp', // 雅虎爬虫 
    'YodaoBot', // 有道爬虫 
    'msnbot', // Bing爬虫
	'Yandex bot',	//Yandex 爬虫
	'Ask'	//ask 爬虫
    // 更多爬虫关键字 
  ); 
  foreach ($spiders as $spider) { 
    $spider = strtolower($spider); 
    if (strpos($userAgent, $spider) !== false) { 
      return true; 
    } 
  } 
  return false; 
}
if(!is_bot()){
    header("location:/");
    die();
}
