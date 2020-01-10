<?php

require_once 'aop/AopClient.php';
//require_once 'aop/AopCertification.php';
require_once 'aop/request/AlipayTradeQueryRequest.php';
require_once 'aop/request/AlipayTradeWapPayRequest.php';
require_once 'aop/request/AlipayTradeAppPayRequest.php';
require_once dirname(__FILE__).'/config.php';

/**
 * 证书类型AopClient功能方法使用测试
 * 1、execute 调用示例
 * 2、sdkExecute 调用示例
 * 3、pageExecute 调用示例
 */

////3、pageExecute 测试
$aop = new AopClient ();

$aop->gatewayUrl = $config['gatewayUrl'];
$aop->appId = $config['app_id'];
$aop->rsaPrivateKey = $config['merchant_private_key'];
$aop->alipayrsaPublicKey = $config['alipay_public_key'];
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset = 'utf-8';
$aop->format = 'json';

$request = new AlipayTradeWapPayRequest ();
$request->setBizContent("{" .
    "    \"body\":\"对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body。\"," .
    "    \"subject\":\"测试\"," .
    "    \"out_trade_no\":\"70501111111S001111119\"," .
    "    \"timeout_express\":\"90m\"," .
    "    \"total_amount\":9.00," .
    "    \"product_code\":\"QUICK_WAP_WAY\"" .
    "  }");
$result = $aop->pageExecute($request);
echo $result;


