
<?php
/**

* wechat php test

*/

//define your token

define("TOKEN", "weixin");

$wechatObj = new wechatCallbackapiTest();

$wechatObj->valid();

class wechatCallbackapiTest

{undefined

public function valid()

{undefined

$echoStr = $_GET["echostr"];

//valid signature , option

if($this->checkSignature()){undefined

echo $echoStr;

exit;

}

}

public function responseMsg()

{undefined

//get post data, May be due to the different environments

$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//extract post data

if (!empty($postStr)){undefined

/* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,

the best way is to check the validity of xml by yourself */

libxml_disable_entity_loader(true);

$postObj = simplexml_load_string($postStr, ‘SimpleXMLElement‘, LIBXML_NOCDATA);

$fromUsername = $postObj->FromUserName;

$toUsername = $postObj->ToUserName;

$keyword = trim($postObj->Content);

$time = time();

$textTpl = "

%s

0

";

if(!empty( $keyword ))

{undefined

$msgType = "text";

$contentStr = "Welcome to wechat world!";

$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

echo $resultStr;

}else{undefined

echo "Input something...";

}

}else {undefined

echo "";

exit;

}

}

private function checkSignature()

{undefined

// you must define TOKEN by yourself

if (!defined("TOKEN")) {undefined

throw new Exception(‘TOKEN is not defined!‘);

}

$signature = $_GET["signature"];

$timestamp = $_GET["timestamp"];

$nonce = $_GET["nonce"];

$token = TOKEN;

$tmpArr = array($token, $timestamp, $nonce);

// use SORT_STRING rule

sort($tmpArr, SORT_STRING);

$tmpStr = implode( $tmpArr );

$tmpStr = sha1( $tmpStr );

if( $tmpStr == $signature ){undefined

return true;

}else{undefined

return false;

}

}

}

?>