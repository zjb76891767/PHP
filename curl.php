//Curl 抓取网页
function curl_get_html($url){
    $ch = curl_init();   
    curl_setopt($ch, CURLOPT_URL, $url);            //设置访问的url地址   
    curl_setopt($ch,CURLOPT_HEADER,1);            //是否显示头部信息   
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);           //设置超时   
    curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);   //用户访问代理 User-Agent   
    curl_setopt($ch, CURLOPT_REFERER,_REFERER_);        //设置 referer   
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);      //跟踪301   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r = curl_exec($ch); 
	// $info = curl_getinfo($ch);
	// print_r($info);
	// echo curl_error($ch);
    curl_close($ch);   
    return $r;   
}
