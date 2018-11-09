-- Database: controle_compras

-- DROP DATABASE controle_compras;

-- \l - lista os dbs
\c controle_empresas
-- \c conecta com um db

CREATE DATABASE controle_compras
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Portuguese_Brazil.1252'
    LC_CTYPE = 'Portuguese_Brazil.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
    
    

CREATE TABLE compras(
    id serial primary key,
	valor decimal,
    data date,
    observacao varchar(255),
    recebido smallint
);


-- \d descreve a tabela

-- \i importa o dump

-- ele faz diversos selects, os que possuem diferenças são:

SELECT * FROM compras where valor > 1000 and data != '06-22-2010'; 
-- no meu ps essa data não funciona, porém o '!=' funciona perfeitamente.


INSERT INTO compras (valor, data, observacao, recebido)
VALUES (2000, '2011-09-04', 'carnaval em cancun', 1);

ALTER TABLE compras ALTER COLUMN valor set not null; -- pequena diferença em relação ao mySQL

CREATE TYPE enum_pagamento as enum('cartão','dinheiro', 'boleto');
ALTER TABLE compras ADD COLUMN form_pagto enum_pagamento;

ALTER TABLE compras RENAME form_pagto TO forma_pagamento;

-- não é possível definir uma coluna como not null sem antes eliminar todos valores nulos dentro dela.



ALTER TABLE compras ALTER COLUMN recebido SET DEFAULT 0;
-- Esse comando só estabelece os futuros valores nulos como 0
-- Os antigos valores nulos permanecem iguais.


SELECT to_char(data, 'YYYY') as ano, sum(valor) as total from compras GROUP BY ano;


-- ao utilizarmos o COUNT() o '*' conta todas as linhas e ao passar uma coluna conta apenas os valores não nulos;



select (
	select sum(c1.valor) 
    from compras c1 
    where c1.data between '2014-01-01' and '2014-12-31'
    ) - (
    select sum(c2.valor) 
    from compras c2 
    where c2.data between '2015-01-01' and '2015-12-31'
    );

select sum(c1.valor) - (
	select sum(c2.valor) 
    from compras c2 
    where c2.data between '2015-01-01' and '2015-12-31'
    ) 
from compras c1 
where c1.data between '2014-01-01' and '2014-12-31';
-- duas formas de fazer diferenças entre queries;


-- OPERADORES

< -- para menor
> -- para maior
<= -- para menor ou igual
>= -- para maior ou igual
= -- para igual
<> ou !=  -- para diferente

SELECT max(valor) from compras;
SELECT min(data) from compras;
-- pegam valor maximo e minimo;


-- Ao inserir pode-se adicionar outra inserção colocando novos valores separados por virgula, exemplo:
insert into compras (...) VALUES (...) -- primeira inserção
, (...) -- segunda inserção


select * from Compras c 
join Lojas l 
on c.loja_id = l.id 
and l.nome = 'Carfour';
-- não é necessário colocar um WHERE, apenas uma outra condição no on tem o mesmo efeito;


SELECT * FROM compras c1 JOIN compras c2 ON c1.valor = c2.valor;

