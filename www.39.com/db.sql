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
	primary key (id),
	key shop_price(shop_price),
	key addtime(addtime),
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