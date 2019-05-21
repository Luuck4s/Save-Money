create database db_savemoney;

use db_savemoney;

create table tb_usuario(
cd_email varchar(80) not null,
nm_usuario varchar(80) not null,
cd_senha varchar(60) not null,
cd_pergunta_seguranca int not null,
resposta_seguranca varchar(60) not null,
constraint pk_usuario primary key(cd_email));

create table tb_valores(
id_valor int not null auto_increment,
titulo_valor varchar(100) not null,
tipo_valor varchar(2) not null,
desc_valor varchar(70),
data_valor date not null,
vl_valor decimal(8,2) not null,
cd_email_usuario varchar(80) not null,
constraint pk_valores primary key(id_valor),
constraint fk_valores_usuario foreign key(cd_email_usuario) references tb_usuario(cd_email));

