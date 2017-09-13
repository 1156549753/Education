<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2017/6/26
 * Time: 下午5:21
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2016080600182328",

    //商户私钥 不能用pkcs8.pem中的密钥！！！！！
    'merchant_private_key' => "MIIEowIBAAKCAQEA2MaidYeM9XD6tlPZRQC69mUMiY7960b/SXtI6oi/4qPuI+uzO5d8Aoq6iVGYq9fr7piH5OME8h+vSCUdsCTEjHjm/rtGaDv2cH27fP6N4102iLqHS//6+t/OI5hH8B3v+yDy1obllikg2/Pn1I96rFH4HDhTIkD/xJ6OquH08PaFF9ieKioF8zcw0tXaNum3u9TPf2/fvb8F+RVrPJTIYNXZztOy26lPTF4gjKijg+5fWpgc5yMo8y7/+qpeE86NJWXV/TH9n6+E1M9K6p+troSpRBzhQvyaeKB1q3ACrhmqBG+VQjFO+0XQfX26y2bXOiVVYcFL35gHjeP/0MyO6wIDAQABAoIBABb0keeYPxkOqb39Cxj/hszozncSqVjs38PMRmBvssIxUdqD7yr0U7GBN1erSFuKNfXCOUHHuJJbQJiHNamdeyLU+sEm28HV97bZ2azW1/enu0qnVgR6Sv2eDZo/Wf7XbL5PMuf8yPspx80C+x3LQ9ZTp851OHh8IZmUoM7/tox9nI5/LBwd3kcHwBJOsZIYtv9ODab7ISR8Ok0h02lWM8RCfEuJcrslSzdp2PnXPqZECdu7yyQbMcItrBn0nn2cxJOO3MF8kn1a1EgXRrxXTONTF3FPiPwSoRsdOHHz78cigOoaegPnlXQJ/MfBAxIeHlTroXoT0urcDICEVs6aW4ECgYEA93beam/OuEJvcz38oWkSzD14QmvacAfqAePoYwIr3H6ZjTmb6xAs1lBXJXDq0PO0Q9AfosONvUQpWYFigsyPU98uAIzULBFUawxtinBzpaXiolzPgMDRLpGQ6CzxgGyXhkcZTWkyci7akEsN8nJ/2e6qg49UuOgBW/yOk7cRvlECgYEA4EDI0vYKpxKtzgf7wNEAV1osREvFiINRvaan6+3rULeobuM1MD0ZYQ4jAEi8efo3cnTeCIdjoJqIl0ovfojJZdKPLAnFGtFLjCyVu59Hk/ZWYQrAh3nryKXB9RriMGZP0rZG7lggAuFkSSIj1mWMOrYWGg8E9P07zXvConAmvnsCgYEA8JHHcROWk/xJ2m+VS9kY5CKR6YhuB2E6NXI5NR8kQqt0XR13HRJRdFsQDR7zuARi51XJm3KeNTOxOwkUGnIAmBmr3+8ISHrkZVjkmKPvWUalxw+QzesksC/k/kDK2f03ZNtzlpTA7M3tvj6opVx4PAXQECtjwooQ4Drq5GEhR7ECgYBlNZftblH8eXerxvqeWTV4NyBHapMqO2pG19JtrqFHerwv36d/r/OmVAUD+c/mlUE1DP2wh7o1H8mJzleFGiMbK16ml3o30kHwb6bcWNSrOMBfZ8Tg3+vEUNsqzglLosFf7hgxNeCsrCDgyOG3v3j8fnWXKTQphajZ4oNDYK57xQKBgBIqJEZQHPMAk+dgPhOU1913TLuhMD96sYdg1JhJ2KqFyg05GgUD+ie2VPeWh+VV9J7HG8IR/Kk/wsg6FqtrtcXZoj97+pAV9u9Eq68msTvb8T9R4mgQ0rTozgY10W7guIzVCdR2FSEyCLnQuTdVYYwx8wFYEm6GNiEZ00uyg/VE",


    //异步通知地址post
    'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

    //同步跳转get
    //'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",
    'return_url' => "http://live.fgwen.top/home/shop/cart_complete",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3ArPusUQFhY4y2fbd0QVkE8iemeiXyEr2XSmkB0B/YxsBdeic0r10JAT2Ei8klpndbhJ1KVAtYv9o3DGstUqaAyOkVa25CgDRFajAhmxvBbc1/c0rgy45+FWgQEFTJW+7w5LUAAYsW80QwYd5QC50Go7FfEtLtP9pETcsW2K4yL84hO8ghs5VoAAaKfTJQmeQT1pkKV3xHnnvo9+8ChR2/LkGtfBc1AM53nR8jbsAbRFeOI9V9qDqEyegJfa0PtdKG+rZDMm0sad/vYuC5IAUjFjoI6/kKF2NccEI52kDh4i7D9/odi187sDm5OdiIfhU3XVaygnssF/E17tmsETfwIDAQAB",

    //支付时提交方式 true 为表单提交方式成功后跳转到return_url,
    //false 时为Curl方式 返回支付宝支付页面址址 自己跳转上去 支付成功不会跳转到return_url上， 我也不知道为什么，有人发现可以跳转请告诉 我一下 谢谢
    // email: 40281612@qq.com
    'trade_pay_type' => true,
];
