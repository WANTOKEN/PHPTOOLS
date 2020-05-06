<?php
$jsonStr = "[
    {
        \"id\": 1000,
        \"name\": \"女士\",
        \"children\": [
            {
                \"id\": 1230,
                \"name\": \"服装\",
                \"children\": [
                    {
                        \"id\": 2191,
                        \"name\": \"裙\",
                        \"children\": [
                            {
                                \"id\": 1111,
                                \"name\": \"连衣裙\"
                            }
                        ]
                    },
                    {
                        \"id\": 1120,
                        \"name\": \"针织衫\"
                    }
                ]
            },
            {
                \"id\": 1200,
                \"name\": \"鞋履\",
                \"children\": [
                    {
                        \"id\": 1210,
                        \"name\": \"高跟鞋\"
                    },
                    {
                        \"id\": 1220,
                        \"name\": \"靴子\"
                    }
                ]
            }
        ]
    },
    {
        \"id\": 2000,
        \"name\": \"男士\",
        \"children\": [
            {
                \"id\": 2100,
                \"name\": \"服装\",
                \"children\": [
                    {
                        \"id\": 4110,
                        \"name\": \"上衣\",
                        \"children\": [
                            {
                                \"id\": 2111,
                                \"name\": \"T恤\"
                            },
                            {
                                \"id\": 2112,
                                \"name\": \"POLO衫\"
                            }
                        ]
                    },
                    {
                        \"id\": 2124,
                        \"name\": \"西装\"
                    }
                ]
            },
            {
                \"id\": 3212,
                \"name\": \"鞋履\",
                \"children\": [
                    {
                        \"id\": 2210,
                        \"name\": \"平底鞋\"
                    },
                    {
                        \"id\": 2220,
                        \"name\": \"运动鞋\",
                        \"children\": [
                            {
                                \"id\": 2221,
                                \"name\": \"篮球鞋\"
                            }
                        ]
                    }
                ]
            }
        ]
    }
]";
$jsonData = json_decode($jsonStr, true);
$target = 1120;
$typeData = [];
function scan($data, $path)
{
    foreach ($data as $v) {
        $vid = $v['id'];
        $name = $v['name'];
        $sub = $name;
        if ($path) $sub = "{$path}>{$name}";
        if (isset($v['children'])) {
            scan($v['children'], $sub);
        } else {
            global $typeData;
            $res = $sub;
            $typeData[$vid] = $res;
        }
    }
}
scan($jsonData, '');
echo isset($typeData[$target])?$typeData[$target]:'';

