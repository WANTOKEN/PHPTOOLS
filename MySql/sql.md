##### 1.轮播图表 cmys_banner 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| image        | varchar(100)     | 否         | 图片       | 
| title        | varchar(50)     | 是         | 标题       | 
| url        | varchar(50)     | 是         | 跳转链接       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 2.校长寄语表 cmys_headmaster 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| name        | varchar(50)     | 否         | 名字       | 
| name_en        | varchar(50)     | 是         | 名字(英文)       | 
| introduce        | varchar(50)     | 否         | 介绍       | 
| introduce_en        | varchar(50)     | 是         | 介绍(英文)       | 
| image        | varchar(100)     | 否         | 封面图片       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| description        | varchar(255)     | 否         | 描述       | 
| description_en        | varchar(255)     | 是         | 描述(英文)       | 
| content        | text     | 否         | 内容       | 
| content_en        | text     | 是         | 内容(英文)       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 3.关于内容表 cmys_about 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| page        | enum('ab_cmjs','ab_ldxy','ab_cgxy','ab_cmjgtd')     | 否         | 页面:ab_cmjs=辰美介绍,ab_ldxy=六大学院介绍,ab_cgxy=参观校园,ab_cmjgtd=辰美架构及管理团队       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| images        | varchar(1500)     | 是         | 图片组       | 
| content        | text     | 是         | 内容       | 
| content_en        | text     | 是         | 内容(英文)       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 4.辰美师资表 cmys_teacher 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| name        | varchar(50)     | 否         | 名字       | 
| name_en        | varchar(50)     | 是         | 名字(英文)       | 
| position        | varchar(50)     | 否         | 任职       | 
| position_en        | varchar(50)     | 是         | 任职(英文)       | 
| image        | varchar(100)     | 否         | 封面图片       | 
| description        | varchar(255)     | 否         | 描述       | 
| description_en        | varchar(255)     | 是         | 描述(英文)       | 
| content        | text     | 是         | 内容       | 
| content_en        | text     | 是         | 内容(英文)       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 5.学院表 cmys_college 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| category_id        | int(10) unsigned     | 是         | 分类ID(单选)       | 
| title        | varchar(50)     | 否         | 学院名称       | 
| title_en        | varchar(50)     | 是         | 学院名称(英文)       | 
| description        | text     | 是         | 学院描述       | 
| description_en        | text     | 是         | 学院描述(英文)       | 
| image        | varchar(100)     | 否         | 封面图片       | 
| seo        | varchar(255)     | 是         | seo描述       | 
| images        | varchar(1500)     | 是         | 图片组       | 
| content        | text     | 是         | 学院介绍内容       | 
| content_en        | text     | 是         | 学院介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 6.教学体系内容表 cmys_tsystem 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| page        | enum('jx_jstx','jx_cmldxy','jx_igxz','jx_btxz','jx_esra')     | 否         | 页面:jx_jstx=三维课程,jx_cmldxy=辰美六大学院,jx_igxz=IG、Al-evel学制介绍,jx_btxz=BTEC学制介绍,jx_esra=法国ESRA预科项目       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| content        | text     | 是         | 介绍内容       | 
| content_en        | text     | 是         | 介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 7.校园动态与新闻表 cmys_news 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| category_id        | int(10) unsigned     | 是         | 分类ID(单选)       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| image        | varchar(100)     | 是         | 封面图片       | 
| seo        | varchar(255)     | 是         | seo描述       | 
| url        | varchar(255)     | 是         | 跳转链接       | 
| description        | varchar(255)     | 是         | 新闻描述       | 
| description_en        | varchar(255)     | 是         | 新闻描述(英文)       | 
| content        | text     | 是         | 新闻内容       | 
| content_en        | text     | 是         | 新闻内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 8.校历表 cmys_calendar 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| image        | varchar(100)     | 否         | 图片       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 9.辰美电视台表 cmys_video 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| category_id        | int(10) unsigned     | 否         | 分类ID(单选)       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| image        | varchar(100)     | 是         | 封面图片       | 
| seo        | varchar(255)     | 是         | seo描述       | 
| video        | varchar(100)     | 是         | 视频       | 
| url        | varchar(255)     | 是         | 跳转链接       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 10.升学服务内容表 cmys_service 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| content        | text     | 否         | 介绍内容       | 
| content_en        | text     | 是         | 介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 11.国外艺术学院表 cmys_college_overseas 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| category_ids        | varchar(100)     | 否         | 分类ID(多选)       | 
| name        | varchar(50)     | 否         | 学院名称       | 
| name_en        | varchar(50)     | 是         | 学院名称(英文)       | 
| logoimage        | varchar(100)     | 否         | 学院徽章       | 
| image        | varchar(100)     | 否         | 封面图片       | 
| description        | varchar(255)     | 否         | 学院描述       | 
| description_en        | varchar(255)     | 是         | 学院描述(英文)       | 
| json        | varchar(255)     | 是         | 配置:key=名称,value=值       | 
| content        | text     | 否         | 学院介绍内容       | 
| content_en        | text     | 是         | 学院介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 12.辰美故事表 cmys_story 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| image        | varchar(100)     | 否         | 封面图片       | 
| url        | varchar(50)     | 否         | 跳转链接       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 13.招生信息内容表 cmys_studentpage 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| page        | enum('zs_zsjz','zs_price','zs_zswd','zs_hdyy')     | 否         | 页面:zs_zsjz=招生简章,zs_price=新生奖学金,zs_zswd=Q&A 招生问答,zs_hdyy=活动（体验课）预约       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| content        | text     | 否         | 介绍内容       | 
| content_en        | text     | 是         | 介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 14.联系我们内容表 cmys_linkwe 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         | ID       | 
| page        | enum('lx_lxwm','lx_zpxx')     | 否         | 页面:lx_lxwm=联系方式,lx_zpxx=招聘信息       | 
| title        | varchar(50)     | 否         | 标题       | 
| title_en        | varchar(50)     | 是         | 标题(英文)       | 
| content        | text     | 否         | 介绍内容       | 
| content_en        | text     | 是         | 介绍内容(英文)       | 
| weigh        | int(10)     | 否         | 排序权重       | 
| switch        | tinyint(1)     | 否         | 显示开关       | 
| createtime        | int(10)     | 是         | 创建时间       | 
| updatetime        | int(10)     | 是         | 更新时间       | 
| deletetime        | int(10)     | 是         | 删除时间       | 


##### 1.banner表 jsyl_banner 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_app        | varchar(255)     | 否         | app端图片地址       | 
| url        | varchar(255)     | 否         | 跳转地址       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 2.logo表 jsyl_logo 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 3.广告位表 jsyl_advertisement 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 4.新闻表 jsyl_news 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| title        | varchar(255)     | 否         | 新闻标题       | 
| img        | varchar(255)     | 否         | 预览图片地址       | 
| tag        | varchar(100)     | 否         | 标签NEW       | 
| description        | text     | 否         | 描述       | 
| content        | longtext     | 否         | 新闻内容       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| is_recomd        | tinyint(1)     | 否         | 0:不推荐；1:推荐       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 5.商品表 jsyl_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img_pre        | varchar(255)     | 否         | 预览图片地址       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_list        | text     | 否         | 图片列表       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 原价格       | 
| display_price        | decimal(10,2)     | 否         | 显示价格       | 
| stock        | int(11) unsigned     | 否         | 库存       | 
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
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 6.限时商品表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 7.商品专区分类表 jsyl_goods_type 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 8.校园动态与新闻表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 9.商品专种类分类表 jsyl_goods_kind 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| parent_id        | int(10) unsigned     | 否         | 父级ID       | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| level        | int(10) unsigned     | 否         | 层级       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 10.采购订单表 jsyl_orders 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
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
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| title1        | varchar(100)     | 否         | 大标题       | 
| title2        | varchar(100)     | 否         | 小标题       | 
| content        | varchar(255)     | 否         | 内容       | 
| type        | varchar(100)     | 否         | 1:重磅金技，2:供求金链，3:全域金代，4:天下金涂       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 12.联系信息表 jsyl_contact 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
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
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| files_name        | varchar(255)     | 否         | 文件名字       | 
| url        | varchar(255)     | 否         | 文件地址       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:启用       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 1.banner表 jsyl_banner 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_app        | varchar(255)     | 否         | app端图片地址       | 
| url        | varchar(255)     | 否         | 跳转地址       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 2.logo表 jsyl_logo 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 3.广告位表 jsyl_advertisement 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| img        | varchar(255)     | 否         | 图片地址       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 4.新闻表 jsyl_news 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| title        | varchar(255)     | 否         | 新闻标题       | 
| img        | varchar(255)     | 否         | 预览图片地址       | 
| tag        | varchar(100)     | 否         | 标签NEW       | 
| description        | text     | 否         | 描述       | 
| content        | longtext     | 否         | 新闻内容       | 
| place        | varchar(100)     | 否         | 放置位置       | 
| is_recomd        | tinyint(1)     | 否         | 0:不推荐；1:推荐       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:开启；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 5.商品表 jsyl_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img_pre        | varchar(255)     | 否         | 预览图片地址       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| img_list        | text     | 否         | 图片列表       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 原价格       | 
| display_price        | decimal(10,2)     | 否         | 显示价格       | 
| stock        | int(11) unsigned     | 否         | 库存       | 
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
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 6.限时商品表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 7.商品专区分类表 jsyl_goods_type 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 8.校园动态与新闻表 jsyl_limit_goods 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| name        | varchar(255)     | 否         | 商品名称       | 
| img        | varchar(255)     | 否         | 图片地址       | 
| detail        | longtext     | 是         | 商品详情       | 
| price        | decimal(10,2)     | 否         | 价格2(31-60吨)       | 
| stock        | int(11) unsigned     | 否         | 库存(吨)       | 
| tag        | varchar(100)     | 否         | 标签       | 
| prcent        | int(3)     | 否         | 进度(0-100)       | 
| type        | varchar(100)     | 否         | 1:正在发布，2:即将开始       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| act_start_time        | datetime     | 否         | 活动开始时间可修改       | 
| act_end_time        | datetime     | 否         | 活动结束时间可修改       | 
| status        | tinyint(1)     | 否         | 0:下架；1:上架；       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 9.商品专种类分类表 jsyl_goods_kind 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| parent_id        | int(10) unsigned     | 否         | 父级ID       | 
| name        | varchar(255)     | 否         | 分类名称       | 
| sort        | int(10) unsigned     | 否         | 排序，升序越大越靠后       | 
| level        | int(10) unsigned     | 否         | 层级       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 10.采购订单表 jsyl_orders 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
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
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| title1        | varchar(100)     | 否         | 大标题       | 
| title2        | varchar(100)     | 否         | 小标题       | 
| content        | varchar(255)     | 否         | 内容       | 
| type        | varchar(100)     | 否         | 1:重磅金技，2:供求金链，3:全域金代，4:天下金涂       | 
| sort        | int(10) unsigned     | 否         | 排序，倒序越大越靠前       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


##### 12.联系信息表 jsyl_contact 

| 字段        | 类型     | 是否为空         | 字段描述        | 
| ----------- | ------------ | ------------------------ | 
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
| ----------- | ------------ | ------------------------ | 
| id        | int(10) unsigned     | 否         |        | 
| files_name        | varchar(255)     | 否         | 文件名字       | 
| url        | varchar(255)     | 否         | 文件地址       | 
| status        | tinyint(1)     | 否         | 0:禁用；1:启用       | 
| create_time        | datetime     | 否         |        | 
| update_time        | datetime     | 否         |        | 


