<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2016091700530478",

    //商户私钥
    'merchant_private_key' => "MIIEowIBAAKCAQEApR8KL1JzNKlMcUpfiJZpQ2bCYuw3vNOCVPYl3n657J18SH9YJnMvulw6z3fntVfrGKiZIN7mU9I8bjHdF2TtePMnvws2A68zBLL+DDoAZNuiaVXIq8dsmYy3vIFuXRNzizGJ5HCZ39w2hOoXu75+J4luKeEQ+ttQaLX+MUht9YCiJwG8kbHtYawQ3LhZXLR0CTdBh7siqfqFQc5LXaaxO7LiPsEbqalx3mNgvjLa3uRCgzmVtjGGDP/LXd/wnUk5A2pl5sNqLL3QQYgCgkXeLoCTuxr8rhAB/DXbtT5PPZWpk/7Tsag4Uj+21hvn0EFaXlhzRyhRrVeUniTEPfYaCwIDAQABAoIBAGAZZpYQCFi3x3OP83XNBEpj/fIQxIezGYFVGMkbPB4HshOHecg29aoij1+7yzDxkDPzu9sznx1dmCoR/zjkVok0CwfXAIK4bprniY+YGi6Y3Tcs4/OFxyC+kxi0w4SME40JMdWv6v4sbdaBX3q27TkZdPIOuREmnu+yK9SG8OgWG0ZmB+WAohf8+D7apHuatdrJRervoGA2JgS3T5PgrsKxwdLLdH0H5dNKCs3Go2Xfx/RBsHsbIVgOXtuzt9rZ9WjfaK8C1GfQD7hc3WAAD6Tc4UBhlGR5GfWSB6Z/UYqP44ZzY/Ye0xsRK57+WJc0V9YtQ4j+gfWxtHqJ4ZqlW/ECgYEA3dw+HwjTdzO3eZssI5IDHGBgHt6gq8/Jwx8xhCBocEz/5WlbBlMyYwsGNowE5GPpWBcvW6Rj2wKjOnQsJ+/mkAYTjymLlEHDc0zj3xIN7GErGjpFH+Wx3aZYTJXkIfceKqEXelfvO+dNV7t7zwmPdK58aeWHm4Fowlgdti7M5bcCgYEAvoer2o+k8c5VIZmdDDQ74HZHohoh6z+upIDxqqp+1+XE4LG14KkccYHlv6C9SpNIP/FrIFTQ9DDSZ7BThtuhdB9IJJ6doU6JgFLiQDZrrmIJQU3OmFlmHNPAV178lnno1/HL/Tb2vUmkInSXDVeixny40LScmPzOHtplNOBjDk0CgYBmtz8zkxyEhbceYA8xcLpr+trFsADnSs54vgpox7BSvfODvSFdbktXu5Tm0DC7pN414JYWcaehkDkOKRcAbntqlsWbdHqg60mYKjMd5ff4Rox0GiJCwE929TrQSl1StFyNFAQQqoGiVFZklfKeSijWtqn3RUNhZaqgv7cRz90hRQKBgQCvV7p/nPymkEXmczGF3rhQHWpVM4mNr4Cw4f4GG3w6grmKM+H3DIshpvLiRTKPZDX0qt/01Dms0RWB2VM1ZAEVFgjVsqfMoLOIRj7z62F0DcMIt2tu569CzllPzxnT/gOcYGlj8mZm01PbZcLxw3oJAxUu9Vi8rsOev0yuueZPbQKBgFvb5abeanNvwVoRk0ew3+FB/YUPhcEUyQthKlplhw3DG50zFhVkTuNy6O9tJr1NCvfrhmaQVZNeiSajL7g51sx7y4WTrL4kqHcdBa3/kGxdEdBoKdHxH/bpaez95rqkLsc/apDtvRxTOPuaL8jCGV9XnWN2FS3YWRItz5HfHuZH",

    //异步通知地址
    'notify_url' => "http://47.106.253.201/PHPPay/AliPay/notify_url.php",

    //同步跳转
    'return_url' => "http://47.106.253.201/PHPPay/AliPay/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2", //RSA2:2048 RSA:1024

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",
//		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",//正式

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAz8FHPkd+vohgEDYIjn5ndwlOjDOVsFIsd+DMUuyNeq9QuTSqBCKOFCWfuQkzaye79JYcu9x2e14maUE3YjJ5Z2bvGjXL8FSW5ux3aoBPOGefyz6CvAX44mM1xhkc8scugmz4EaFivi3fpfyKTCiZL/lCy7zq47jPxMSFlg4452JITopHdDmU4NR01tcJygKeAMBm9W4Cozes3PZHNmNlPM+YE1yHYwrulRzTCVUfAE2afhsKsP4EXxcTZhvgudf2soxgJwRZ1gBxA63XZFDq9qdjMRsZG4S9qhudD0bLsDmNswfUW87422Ogz1VP+RyU5UmeH2tPjoJGDbu5Xd2ivQIDAQAB"
);