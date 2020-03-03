mysql -u root -p 
-- Para acessar o mysql via cmd

-- criando banco
CREATE DATABASE controle_compras;
USE controle_compras;

-- criando tabela
CREATE TABLE compras(
	id int auto_increment primary key,
    valor double,
    data date,
    descricao varchar(255),
    observacoes varchar(255),
    recebido boolean
);

mysql -u root -p controle_compras < cap2.sql 
-- importanto arquivo

-- SELECT
SELECT valor, observacoes 
FROM compras
WHERE data > '2008-12-15';

-- AND
SELECT * FROM compras
WHERE valor > 1000 AND valor < 5000;

-- todo texto pode ser passado tanto em aspas simples quanto dupla, porém a aspas simples
-- facilita quando se mistura sql em outra linguagem de programação

-- INTERVALOS
SELECT * FROM compras 
WHERE data >= '2008-12-15' AND data <= '2010-12-15';

SELECT * FROM compras 
WHERE valor >= 15 AND valor <= 35 AND observacoes LIKE 'LANCHONETE%';

-- BOOLEAN
SELECT * FROM compras WHERE recebido = true; 
-- ou recebido = 1;

SELECT * FROM compras WHERE recebido = false; 
-- ou recebido = 0;

INSERT INTO COMPRAS (VALOR, DATA, OBSERVACOES, RECEBIDO) 
VALUES (100.0, '2010-09-08', 'COMIDA', TRUE); 
-- isso prova que 1 e true são sinonimos


SELECT * FROM compras 
WHERE valor > 5000.47 OR recebido = true; 
-- casas decimais serão representadas assim "."

-- ()
SELECT * FROM compras 
WHERE (valor >= 1000 and valor <= 3000) or (valor >= 5000);

-- BETWEEN
SELECT * FROM compras 
WHERE valor BETWEEN 200 AND 700; 
-- é inclusivo nos 2 valores ">="/"<="

SELECT * FROM COMPRAS 
WHERE data BETWEEN '2010-01-05' AND '2010-06-25';
-- Funciona com datas


-- UPDATE
UPDATE compras SET observacoes = 'compra emergencial';
-- Updates sem where alteram todas as linhas

UPDATE COMPRAS SET OBSERVACOES = 'preparando o natal' 
WHERE DATA = '2010-12-20';

UPDATE compras SET observacoes = 'datas festivas' 
WHERE data IN('2010-12-25', '2010-10-12', '2010-06-12');

UPDATE compras
SET valor = valor + 10
WHERE data < '2009-06-01';
-- somando + 10 ao valor

UPDATE compras 
SET observacoes = ' entregue antes de 2011', recebido = true
WHERE data BETWEEN '2009-07-01' AND '2010-07-01';
-- between deve ser BETWEEN valor_minimo AND valor_maximo;


-- DELETE
DELETE FROM compras WHERE data < '2009-01-01';
-- exclui todas as linhas sem o where

DELETE FROM compras
WHERE data BETWEEN '2009-03-05' AND '2009-03-20';

-- NOT
SELECT * FROM compras
WHERE NOT valor = 108;


DESC compras;
-- descreve a estrutura da tabela


-- NULL
INSERT INTO COMPRAS (VALOR, DATA, OBSERVACOES, RECEBIDO) 
VALUES (100.0, '2010-10-10', NULL, 1);

ALTER TABLE compras MODIFY COLUMN observacoes TEXT NOT NULL;
-- não permite valores null anymore


-- DEFAULT
ALTER TABLE COMPRAS MODIFY COLUMN RECEBIDO TINYINT(1) DEFAULT '0';
-- caso o valor não seja preenchido, automaticamente instaura-se o padrão

INSERT INTO COMPRAS (VALOR, DATA, OBSERVACOES) 
VALUES (189.76, '2009-02-09', 'UMA COMPRA QUALQUER');
-- inserindo pra testar o valor padronizado
SELECT * FROM compras WHERE id = 44;


-- ENUM
ALTER TABLE compras ADD COLUMN forma_pgt ENUM('cartao', 'boleto', 'dinheiro');
-- o novo campo aceita apenas 3 valores pré-definidos
INSERT INTO COMPRAS (VALOR, DATA, OBSERVACOES, FORMA_PGT) 
VALUES (189.76, '2010-02-09', 'UMA OUTRA COMPRA QUALQUER', 'CARTAO');
-- inserindo pra testar a coluna criada
ALTER TABLE COMPRAS CHANGE FORMA_PGT FORMA_PAGT ENUM('CARTAO', 'BOLETO', 'DINHEIRO');
-- renomeando a coluna
SELECT * FROM compras WHERE id = 45;

UPDATE compras 
SET forma_pagt = 'boleto'
WHERE forma_pagt IS null;
-- definindo os valores das colunas nulas
-- quando se usa o null utiliza-se o 'IS' e não '='


-- SUM
SELECT SUM(valor) FROM compras;

SELECT SUM(valor) FROM compras WHERE data < '2010-01-01';


-- AVG
SELECT AVG(valor) FROM compras WHERE data < '2010-01-01';

SELECT AVG(valor) AS media, SUM(valor) AS soma FROM compras WHERE data < '2010-01-01';
-- o 'AS' coloca o valor na coluna criada


-- COUNT
SELECT COUNT(valor) FROM compras WHERE data < '2010-01-01';
SELECT COUNT(id) FROM compras WHERE data < '2009-05-12' AND recebido = 1;
-- como não importa a coluna selecionada para a contagem, também pode-se:
SELECT COUNT(1) FROM COMPRAS WHERE DATA < '2009-05-12' AND RECEBIDO = 1;


-- GROUP BY
SELECT SUM(valor) FROM compras WHERE recebido = 1;
SELECT SUM(valor) FROM compras WHERE recebido = 0;
-- para agrupar as duas consultas numa só:
SELECT SUM(valor) FROM compras GROUP BY recebido;
-- ele agrupa as somas em função de cada valor do recebido
-- porém não sabemos qual linha é qual, para isso:
SELECT recebido, SUM(valor) FROM compras GROUP BY recebido;

SELECT recebido, SUM(valor) AS soma, COUNT(valor) AS total FROM compras GROUP BY recebido;
-- sairá o resultado sem lógica de ordem, para isso:


-- ORDER BY
SELECT recebido, SUM(valor) AS soma, COUNT(valor) AS total FROM compras GROUP BY recebido ORDER BY soma DESC;
-- decrecente

SELECT recebido, SUM(valor) AS soma, COUNT(valor) AS total FROM compras GROUP BY recebido ORDER BY soma ASC;
-- ascendente
compras

CREATE TABLE COMPRADORES (
      ID INT NOT NULL AUTO_INCREMENT,
      NOME VARCHAR(100) NOT NULL,
      ENDERECO VARCHAR(100) NOT NULL,
      TELEFONE VARCHAR(20) NOT NULL,
      PRIMARY KEY(ID)
    );
-- criando

INSERT INTO COMPRADORES (NOME, ENDERECO, TELEFONE) 
VALUES ('MAURICIO', 'RUA VERGUEIRO, 123', '(11) 1111-1111');
INSERT INTO COMPRADORES (NOME, ENDERECO, TELEFONE) 
VALUES ('ADRIANO', 'AV. PAULISTA, 456', '(11) 2222-2222');
-- inserindo

ALTER TABLE COMPRAS ADD COLUMN COMPRADOR_ID INT NOT NULL;
-- adicionando coluna para a chave estrangeira

UPDATE COMPRAS SET COMPRADOR_ID = 1 WHERE ID < 8;
UPDATE COMPRAS SET COMPRADOR_ID = 2 WHERE ID >= 8;
-- colocando valores na nova coluna


-- JOIN
SELECT * FROM COMPRAS, COMPRADORES;
-- assim, uma tabela confusa aparece
SELECT * FROM compras JOIN compradores ON compras.comprador_id = compradores.id;
-- assim, uma tabela interligada pela chave estrangeira aparece devidamente
SELECT nome, valor 
FROM compras 
JOIN compradores 
ON compras.comprador_id = compras.id;

SELECT compras.* -- seleciona apenas os dados de compras
FROM compras 
INNER JOIN compradores 
ON compras.comprador_id = compradores.id 
WHERE nome LIKE 'GUILHERME%';

SELECT compradores.nome, sum(valor) 
FROM compras
INNER JOIN compradores
ON compras.comprador_id = compradores.id
GROUP BY compradores.nome;


SELECT * FROM compras INNER JOIN compradores ON compras.comprador_id = compradores.id WHERE comprador_id = 1;



ALTER TABLE compras ADD FOREIGN KEY (comprador_id) REFERENCES compradores(id);
-- assim, efetivamente a coluna se torna uma chave estrangeira
