# products
Cadastro de Produtos e Tags

SQL BASE DO PROJETO

CREATE TABLE `product` (<br>
  `id` int NOT NULL AUTO_INCREMENT,<br>
  `name` varchar(50) NOT NULL,<br>
  PRIMARY KEY (`id`),<br>
  UNIQUE KEY `name_UNIQUE` (`name`)<br>
);
<br>
<br>
CREATE TABLE `tag` (<br>
  `id` int NOT NULL AUTO_INCREMENT,<br>
  `name` varchar(50) NOT NULL,<br>
  PRIMARY KEY (`id`),<br>
  UNIQUE KEY `name_UNIQUE` (`name`)<br>
);
<br>
<br>
CREATE TABLE `product_tag` (<br>
   `product_id` int NOT NULL,<br>
   `tag_id` int NOT NULL,<br>
   PRIMARY KEY (`product_id`,`tag_id`),<br>
   CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),<br>
   CONSTRAINT `tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)<br>
);<br>

****************************************************

CRUD DE PRODUTOS
- é possível adicionar, atualizar, deletar o nome do produto e as tags que ele está vinculado

CRUD DE TAGS
- é possível adicionar, atualizar, deletar o nome da tag

****************************************************

SQL DO RELATÓRIO
SELECT count(distinct(product_id)) FROM product_tag

