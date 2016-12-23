<?php
function add_b($content){
	//关键词加粗
	$key=array('Circulating Fluidized Bed boiler','fluidized bed boiler','Steam Generation','steam boiler','coal fired steam boiler','coal fired boiler','cfb boiler','autoclave','biomass boiler','biomass fired boiler','hot water boiler','power plant boiler','chain grate boiler','waste heat boiler','gas fired boiler','gas boiler','oil fired boiler','oil boiler',get_the_title());
foreach($key as $k){
$content=preg_replace("/\b$k\b/i","<strong>$k</strong>",$content,1);
}
return $content;
}
add_filter("the_content","add_b");

function add_link($title){
	//根据关键词调用相关链接
	$arr=array('cfb'=>'<a href=http://www.z-boiler.top/cfb-power-plant-boiler/>CFB POWER PLANT BOILER</a>',
				'power plant'=>'<a href=http://www.z-boiler.top/cfb-power-plant-boiler/>CFB POWER PLANT BOILER</a>',
				'dzl'=>'<a href=http://www.z-boiler.top/dzl-packaged-biomasse-boiler-2/>DZL PACKAGED BIOMASSE BOILER</a>',
				'biomass'=>'<a href=http://www.z-boiler.top/dzl-packaged-biomasse-boiler-2/>DZL PACKAGED BIOMASSE BOILER</a>',
				'autoclave'=>'<a href=http://www.z-boiler.top/electric-opening-autoclave/>ELECTRIC-OPENING AUTOCLAVE</a>',
				'horizontal'=>'<a href=http://www.z-boiler.top/horizontal-gas-fired-steam-boiler/>HORIZONTAL GAS FIRED STEAM BOILER</a>',
				'gas'=>'<a href=http://www.z-boiler.top/horizontal-gas-fired-steam-boiler/>HORIZONTAL GAS FIRED STEAM BOILER</a>、&nbsp;&nbsp;<a href=http://www.z-boiler.top/szs-gas-fired-steam-boiler/>SZS GAS FIRED STEAM BOILER</a>',
				'steam boiler'=>'<a href=http://www.z-boiler.top/horizontal-gas-fired-steam-boiler/>HORIZONTAL GAS FIRED STEAM BOILER</a>',
				'WASTE'=>'<a href=http://www.z-boiler.top/waste-heat-recovery-boiler/>WASTE HEAT RECOVERY BOILER</a>'
				);
	$tag="Relate link:&nbsp;<a href=".home_url(add_query_arg(array())).">".$title."</a>、";
	foreach($arr as $k=>$v){
		preg_match("/\b$k\b/i",$title,$match);
		if(!empty($match)){
			preg_match('/<a href=(.*?)>(.*?)<\/a>/i',$v,$match2);
			$t=$match2[2];
			preg_match("/\b$t\b/i",$tag,$arr2);
			if(empty($arr2)){
			$tag.=$v."、 ";
			}
		}
	}
	return $tag;
}

function count_word($str){
//计算单词个数
$parrten = "/[0-9a-zA-Z]+/";
preg_match_all($parrten,$str,$arr,PREG_SET_ORDER);
return count($arr);
}
// 如果正文内容少于一定数量，根据关键词相关性调用内容
$ttt=get_the_content();
if(count_word($ttt)<200){
	$keys=array('coal'=>'',			//''内添加对应的内容
				'biomass'=>'',
				'gas'=>'',
				'oil'=>'',
				'cfb'=>'',
				'autoclave'=>'');
	$title=get_the_title();
	$i=0;
	foreach($keys as $k=>$v){
		$regular = "/\b$k\b/i";
		preg_match($regular,$title,$arr);
		if(!empty($arr)){
			$mm=$k;
			$i++;
		}
	}
	if($i==1){
		echo $keys[$mm];
	}else{
		echo "";	//引号里添加public内容
	}
}
