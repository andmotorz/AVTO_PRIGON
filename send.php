<?php
// Положите на хостинг с PHP. Токен и chat_id — только здесь, не в JS.
const TOKEN='BOT_TOKEN'; const CHAT='CHAT_ID';
$d=json_decode(file_get_contents('php://input'),true);
if(!is_array($d)||!empty($d['website'])){http_response_code(400);exit;}
unset($d['website']);
$t="Новая заявка\n";
foreach(array_slice($d,0,15,true) as $k=>$v){
  $v=trim((string)$v);
  if($v!=='')$t.=htmlspecialchars((string)$k).': '.htmlspecialchars(mb_substr($v,0,500))."\n";
}
$c=curl_init('https://api.telegram.org/bot'.TOKEN.'/sendMessage');
curl_setopt_array($c,[CURLOPT_POST=>1,CURLOPT_RETURNTRANSFER=>1,CURLOPT_TIMEOUT=>10,
 CURLOPT_POSTFIELDS=>['chat_id'=>CHAT,'text'=>$t,'parse_mode'=>'HTML']]);
$r=curl_exec($c);
$ok=$r&&(json_decode($r,true)['ok']??false);
http_response_code($ok?200:502);
