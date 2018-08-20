create database php39;
use php39;
set names utf8;

drop table if exists p39_goods;
create table p39_goods
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_name varchar(150) not null comment '商品名称',
	market_price decimal(10,2) not null comment '市场价格',
	shop_price decimal(10,2) not null comment '本店价格',
	goods_desc longtext comment '商品描述',
	is_on_sale enum('是','否') not null default '是' comment '是否上架',
	is_delete enum('是','否') not null default '否' comment '是否放到回收站',
	addtime datetime not null comment '添加时间',
	logo varchar(150) not null default '' comment '原图',
	sm_logo varchar(150) not null default '' comment '小图',
	mid_logo varchar(150) not null default '' comment '中图',
	big_logo varchar(150) not null default '' comment '大图',
	mbig_logo varchar(150) not null default '' comment '更大图',
	brand_id mediumint unsigned not null default '0' comment '品牌ID',
	cat_id mediumint unsigned not null default '0' comment '主分类ID',
	type_id mediumint unsigned not null default '0' comment '类型ID',
	promote_price decimal (10,2) not null default '0.00' comment '促销价格',
	promote_start_date datetime not null comment '促销开始时间',
	promote_end_date datetime not null comment '促销结束时间',
	is_new enum('yes','no') not null default 'no' comment '是否新品',
	is_hot enum('yes','no') not null default 'no' comment '是否热卖',
	is_best enum('yes','no') not null default 'no' comment '是否精品',
	is_floor enum('yes','no') not null default 'no' comment '是否推荐楼层',
	sort_num tinyint unsigned not null default '100' comment '排序的数字',
	is_updated tinyint unsigned not null default '0' comment '是否被修改',
	primary key (id),
	keyp promote_price(promote_price),
	keyp promote_start_date(promote_start_date),
	keyp promote_end_date(promote_end_date),
	keyp is_new(is_new),
	keyp is_hot(is_hot),
	keyp is_best(is_best),
	key shop_price(shop_price),
	key addtime(addtime),
	key brand_id(brand_id),
	key sort_num(sort_num),
	key cat_id(cat_id),
	key is_on_sale(is_on_sale)
)engine=InnoDB default charset=utf8 comment '商品';

drop table if exists p39_brand;
create table p39_brand
(
	id mediumint unsigned not null auto_increment comment 'Id',
	brand_name varchar(30) not null comment '品牌名称',
	site_url varchar(150) not null default '' comment '官方网址',
	logo varchar(150) not null default '' comment '品牌Logo图片',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '品牌';

drop table if exists p39_member_level;
create table p39_member_level
(
	id mediumint unsigned not null auto_increment comment 'Id',
	level_name varchar(30) not null comment '级别名称',
	jifen_bottom mediumint unsigned not null comment '积分下限',
	jifen_top mediumint unsigned not null comment '积分上限',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '会员级别';

drop table if exists p39_member_price;
create table p39_member_price
(
	id mediumint unsigned not null auto_increment comment 'Id',
	price decimal(10,2) not null comment '会员价格',
	level_id mediumint unsigned not null comment '级别ID',
	goods_id mediumint unsigned not null comment '商品ID',
	primary key (id),
	key goods_id(goods_id),
	key level_id(level_id),
)engine=InnoDB default charset=utf8 comment '会员价格';

//商品分类
drop table if exists p39_category;
create table p39_category
(
	id mediumint unsigned not null auto_increment comment 'Id',
	cat_name varchar(30) not null comment '分类名称',
	parent_id mediumint unsigned not null comment '上级分类',
	is_floor enum('yes','no') not null default 'no' comment '是否推荐楼层'
	primary key (id),
)engine=InnoDB default charset=utf8 comment '商品分类';


insert into p39_category(id,cat_name,parent_id,) values
(1,'家用电器',0),
(2,'手机、数码、京东通信',0),
(3,'电脑、办公',0),
(4,'家居、家具、家装、厨具',0),
(5,'男装、女装、内衣、珠宝',0),
(6,'个护化妆',0),
(21,'iphone',2),
(8,'运动户外',0),
(9,'汽车、汽车用品',0),
(10,'母婴、玩具乐器',0),
(11,'食品、酒类、生鲜、特产',0),
(12,'营养保健',0),
(13,'图书、音像、电子书',0),
(14,'彩票、旅行、充值、票务',0),
(15,'理财、众筹、白条、保险',0),
(16,'大家电',1),
(17,'生活电器',1),
(18,'厨房电器',1),
(19,'个护健康',1),
(20,'五金家装',1),
(22,'冰箱',16),


//扩展分类表
drop table if exists p39_goods_cat;
create table p39_goods_cat
(
	id mediumint unsigned not null auto_increment comment 'Id',
	cat_id mediumint unsigned not null auto_increment comment '分类Id',
	goods_id mediumint unsigned not null auto_increment comment '商品Id',
	primary key (id),
	key goods_id(goods_id),
	key gcat_id(cat_id),
)engine=InnoDB default charset=utf8 comment '商品扩展分类';

//类型相关表
drop table if exists p39_type;
create table p39_type
(
	id mediumint unsigned not null auto_increment comment 'Id',
	type_name varchar(30) not null comment '类型名称'
	primary key (id),
)engine=InnoDB default charset=utf8 comment '类型';

//类属性相关表
drop table if exists p39_attribute;
create table p39_attribute
(
	id mediumint unsigned not null auto_increment comment 'Id',
	attr_name varchar(30) not null comment '属性名称',
	attr_type enum('0','1') not null comment '属性类型,0代表唯一，1代表可选',
	attr_options_values varchar(30) not null default '' comment '属性可选值',
	type_id mediumint unsigned not null  comment '类型Id',
	primary key (id),
	key type_id(type_id)
)engine=InnoDB default charset=utf8 comment '类型';

//商品属性表
drop table if exists p39_goods_attr;
create table p39_goods_attr
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	attr_id mediumint unsigned not null  comment '属性Id',
	attr_value varchar(150) not null comment '属性值',
	primary key (id),
	key type_id(type_id)
)engine=InnoDB default charset=utf8 comment '商品属性';


//库存量表
drop table if exists p39_goods_number;
create table p39_goods_number
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	goods_number mediumint unsigned not null default '0' comment '库存量',
	goods_attr_id varchar (150) not null comment '商品属性表的ID，如果有多个，就用程序拼成字符串存到这个字段中',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '库存量';

/*********************************RBAC*****************************/
drop table if exists p39_privilege;
create table p39_privilege
(
	id mediumint unsigned not null auto_increment comment 'Id',
	pri_name varchar (150)  not null  default '' comment '权限名称',
  module_name varchar (30) not null default '' comment '模块名称',
  controller_name varchar (30) not null default '' comment '控制器名称',
  action_name varchar (30) not null default '' comment '方法名称',
  parent_id mediumint unsigned not null default '0' comment '上级权限Id',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '权限';


drop table if exists p39_role;
create table p39_role
(
	id mediumint unsigned not null auto_increment comment 'Id',
	role_name varchar (150)  not null  default '' comment '角色名称',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '角色';


drop table if exists p39_role_pri;
create table p39_role_pri
(
	id mediumint unsigned not null auto_increment comment 'Id',
	pri_id mediumint unsigned not null  comment '权限ID',
	role_id mediumint unsigned not null  comment '角色ID',
	primary key (id),
	key pri_id(pri_id),
	key role_id(role_id)
)engine=InnoDB default charset=utf8 comment '角色权限';


drop table if exists p39_admin;
create table p39_admin
(
	id mediumint unsigned not null auto_increment comment 'Id',
	username varchar (150)  not null   comment '用户名',
	password char(32) not null comment '密码',

	primary key (id)
)engine=InnoDB default charset=utf8 comment '管理员';
INSERT INTO p39_admin (id,username,password) values ('1','root','21232f297a57a5a743894a0e4a801fc3')

drop table if exists p39_admin_role;
create table p39_admin_role
(
	id mediumint unsigned not null auto_increment comment 'Id',
	admin_id mediumint unsigned not null  comment '管理员ID',
	role_id mediumint unsigned not null  comment '角色ID',
	primary key (id),
	key admin_id(admin_id),
	key role_id(role_id)
)engine=InnoDB default charset=utf8 comment '管理员角色';



drop table if exists p39_member;
create table p39_member
(
	id mediumint unsigned not null auto_increment comment 'Id',
	username varchar (150)  not null   comment '用户名',
	password char(32) not null comment '密码',
	face varchar (150) not null default '' comment '头像',
	jifen mediumint unsigned not null default '0' comment '积分',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '会员';


drop table if exists p39_cart;
create table p39_cart
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	goods_attr_id varchar (150) not null default '' comment '商品属性ID',
	goods_number mediumint unsigned not null  comment '购买数量',
	member_id mediumint unsigned not null comment '会员ID',
	primary key (id),
	key member_id(member_id)
)engine=InnoDB default charset=utf8 comment '购物车';




drop table if exists p39_order;
create table p39_order
(
	id mediumint unsigned not null auto_increment comment 'Id',
	member_id mediumint unsigned not null comment '会员ID',
	addtime int unsigned not null comment '下单时间',
	pay_status enum('yes','no') not null default 'no' comment '支付状态',
	pay_time int unsigned not null default '0' comment '支付时间'
	total_price decimal (10,2) not null comment '订单总价',
	shr_name varchar (30) not null comment '收货人姓名',
	shr_tel varchar (30) not null comment '收货人电话',
	shr_province varchar (30) not null comment '收货人省份',
	shr_city varchar (30) not null comment '收货人城市',
	shr_area varchar (30) not null comment '收货人地区',
	shr_address varchar (30) not null comment '收货人详细地址',
	post_status tinyint unsigned not null default '0' comment '配送状态,0：未发货 1：已发货 2：收到货',
	post_number varchar (30) not null default '' comment '快递单号'
	primary key (id),
	key member_id(member_id),
	key addtime(addtime),
)engine=InnoDB default charset=utf8 comment '定单基本信息表';




drop table if exists p39_order_goods;
create table p39_order_goods
(
	id mediumint unsigned not null auto_increment comment 'Id',
	order_id mediumint unsigned not null  comment '定单Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	goods_attr_id varchar (150) not null default '' comment '商品属性id',
	goods_number mediumint unsigned not null  comment '购买的数量',
	price decimal (10,2) not null comment '购买的价格',
	primary key (id),
	key order_id(order_id),
	key goods_id(goods_id),
)engine=InnoDB default charset=utf8 comment '定单商品表';



drop table if exists p39_comment;
create table p39_comment
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	member_id mediumint unsigned not null  comment '会员Id',
	content varchar (200) not null comment '评论内容',
	addtime datetime not null comment '评论时间',
	star tinyint unsigned not null comment '分值',
	click_count smallint unsigned not null default '0' comment '有用的数字',
	primary key (id),
)engine=InnoDB default charset=utf8 comment '评论表';




drop table if exists p39_yinxiang;
create table p39_yinxiang
(
	id mediumint unsigned not null auto_increment comment 'Id',
	goods_id mediumint unsigned not null  comment '商品Id',
	yx_name varchar (30) not null comment '印象名称',
	yx_count smallint  unsigned  not null default '1'  comment '印象次数',
	primary key (id),
)engine=InnoDB default charset=utf8  comment '商品印象表';



drop table if exists p39_comment_reply;
create table p39_comment_reply
(
	id mediumint unsigned not null auto_increment comment 'Id',
	comment_id mediumint unsigned not null  comment '评论Id',
	member_id mediumint unsigned not null  comment '会员Id',
	content varchar (200) not null comment '评论内容',
	addtime datetime not null comment '评论时间',
	primary key (id),
)engine=InnoDB default charset=utf8 comment '商品印象表';



drop table if exists p39_sphinx_id;
create table p39_sphinx_id
(
	id mediumint unsigned not null auto_increment comment 'Id',
	max_id mediumint unsigned not null default '0' comment '评论Id',
	primary key (id),
)engine=InnoDB default charset=utf8 comment 'sphinx';
INSERT INTO p39_sphinx_id values (0);



