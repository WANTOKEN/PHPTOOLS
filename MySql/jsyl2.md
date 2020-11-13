##### 1.banner表 jsyl_banner 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_app        | varchar(255)     | 否         | app端图片地址       | 
| url        | varchar(255)     | 否         | 跳转地址       | 
| m_url        | varchar(255)     | 是         | 移动端跳转       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 2.logo表 jsyl_logo 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 3.广告位表 jsyl_advertisement 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| url        | varchar(255)     | 是         | 跳转地址       | 
| app_url        | varchar(255)     | 是         | 移动端跳转       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 4.新闻表 jsyl_news 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| title        | varchar(255)     | 否         | 新闻标题       | 
| img        | varchar(255)     | 否         | 预览图片地址       | 
| tag        | varchar(100)     | 否         | 标签NEW       | 
| description        | text     | 否         | 描述       | 
| content        | longtext     | 否         | 新闻内容       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| is_recomd        | tinyint(1)     | 否         | 0:不推荐；1:推荐       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| view        | int(11)     | 否         | 访问数       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 5.商品表 jsyl_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img_pre        | varchar(255)     | 否         | 预览图片地址       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_list        | text     | 是         | 图片列表       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 原价格       | 
| display_price        | decimal(10,2)     | 否         | 显示价格       | 
| stock        | int(11) unsigned     | 否         | 库存       | 
| discount        | int(2)     | 否         | 折扣       | 
| kind        | varchar(255)     | 否         | 种类       | 
| param        | varchar(100)     | 否         | 参数       | 
| product_area        | varchar(100)     | 否         | 产地       | 
| model_num        | varchar(100)     | 否         | 型号       | 
| owner_type        | varchar(100)     | 否         | 所属专区分类       | 
| owner_kind_type1        | varchar(100)     | 否         | 所属种类一级类型       | 
| owner_kind_type2        | varchar(100)     | 否         | 所属种类二级类型       | 
| owner_kind_type3        | varchar(100)     | 否         | 所属种类三级类型       | 
| is_recomd        | tinyint(1)     | 否         | 0:不推荐；1:推荐       | 
| is_hot        | tinyint(1)     | 否         | 0:不热销；1:热销       | 
| is_nice        | tinyint(1)     | 否         | 0:不是精品；1:精品       | 
| is_boom        | tinyint(1)     | 否         | 0:不是爆款；1:爆款       | 
| is_special        | tinyint(1)     | 否         | 0:非特价；1:特价       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| view        | int(11)     | 否         | 访问数       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| display        | tinyint(1)     | 否         | 0:不显示价格；1:显示价格；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 6.限时商品表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_list        | text     | 是         | 图片列表       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| price_str        | varchar(255)     | 是         | 库存单位       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| kind        | varchar(255)     | 否         | 种类       | 
| param        | varchar(100)     | 否         | 参数       | 
| product_area        | varchar(100)     | 否         | 产地       | 
| model_num        | varchar(100)     | 否         | 型号       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| view        | int(11)     | 否         | 访问数       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 7.商品专区分类表 jsyl_goods_type 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:不显示价格；1:显示价格；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 8.校园动态与新闻表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_list        | text     | 是         | 图片列表       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| price_str        | varchar(255)     | 是         | 库存单位       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| kind        | varchar(255)     | 否         | 种类       | 
| param        | varchar(100)     | 否         | 参数       | 
| product_area        | varchar(100)     | 否         | 产地       | 
| model_num        | varchar(100)     | 否         | 型号       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| view        | int(11)     | 否         | 访问数       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 9.商品专种类分类表 jsyl_goods_kind 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| parent_id        | int(10) unsigned     | 否         | 父级ID       | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| level        | int(10) unsigned     | 否         | 层级       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 10.采购订单表 jsyl_orders 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| o_id        | varchar(100)     | 否         | 订单id       | 
| goods_name        | varchar(255)     | 否         | 商品名称       | 
| unit        | varchar(255)     | 否         | 采购单位       | 
| receiver        | varchar(255)     | 否         | 联系人       | 
| tel        | varchar(11)     | 否         | 联系电话       | 
| address        | varchar(255)     | 否         | 地址       | 
| remark        | varchar(255)     | 否         | 备注       | 
| num        | varchar(100)     | 否         | 采购数量       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 11.供需专区表 jsyl_special_area 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| title1        | varchar(100)     | 否         | 大标题       | 
| title2        | varchar(100)     | 否         | 小标题       | 
| content        | varchar(255)     | 否         | 内容       | 
| type        | varchar(100)     | 否         | 1:重磅金技，2:供求金链，3:全域金代，4:天下金涂       | 
| detail        | longtext     | 是         | 详情       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 12.联系信息表 jsyl_contact 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(100)     | 否         | 企业名称       | 
| type        | varchar(100)     | 否         | 企业类型       | 
| person        | varchar(255)     | 否         | 联系人       | 
| position        | varchar(255)     | 否         | 担任职位       | 
| tel        | varchar(11)     | 否         | 联系电话       | 
| email        | varchar(255)     | 否         | 邮箱地址       | 
| cooperate_choose        | varchar(255)     | 否         | 合作选项       | 
| cooperate_content        | varchar(255)     | 否         | 合作内容       | 
| cooperate_request        | varchar(255)     | 否         | 合作诉求       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 13.文件表 jsyl_files 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | --------- | ------------- | 
| id        | int(10) unsigned     | 否         |        | 
| files_name        | varchar(255)     | 否         | 文件名字       | 
| url        | varchar(255)     | 否         | 文件地址       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:启用       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


