
create schema temp;

CREATE TABLE "sys"."consultas"
(
   nome varchar(90),
   criado_em timestamp DEFAULT localtimestamp()
);