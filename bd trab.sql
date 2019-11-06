drop database if exists trab;
create database trab;
use trab;

create table laboratorio(
codigo int primary key auto_increment,
numero int
);

create table usuario (
	id int primary key auto_increment,
	nome varchar(255) not null,
	usuario varchar(255) not null,
	senha varchar(255) not null
);

create table agendamento(
codigo int primary key auto_increment,
horario int,
data_inicio datetime,
data_fim datetime
);


create table laboratorio_has_agendamento(
cod_laboratorio int,
cod_agendamento int,
cod_usuario int,
primary key(cod_laboratorio, cod_agendamento),
foreign key (cod_usuario) references usuario(id) on delete no action,
foreign key (cod_laboratorio) references laboratorio(codigo) on delete cascade,
foreign key (cod_agendamento) references agendamento(codigo) on delete cascade
);

CREATE VIEW agenda_lab AS SELECT a.*, u.nome, l.numero, l.codigo as cod_lab FROM agendamento a, laboratorio l, laboratorio_has_agendamento lha, usuario u where lha.cod_laboratorio = l.codigo and lha.cod_agendamento = a.codigo and u.id = lha.cod_usuario;

select * from agenda_lab;

DELIMITER $$ 
CREATE PROCEDURE RetornaUsuarioCredencial(in nome_usuario varchar(255), in senha varchar(255))
BEGIN
    SELECT * FROM usuario u WHERE u.usuario = nome_usuario and u.senha = senha;
END$$

DELIMITER $$
CREATE PROCEDURE ConflitoData(in codigo_lab int, in codigo_ag int)
BEGIN
    SELECT a.* FROM agenda_lab a, agendamento ag where a.cod_lab = codigo_lab and ag.codigo = codigo_ag AND ((ag.data_inicio BETWEEN a.data_inicio AND a.data_fim) or (ag.data_fim BETWEEN a.data_inicio AND a.data_fim));
END$$

-- call ConflitoData(2, 1);
