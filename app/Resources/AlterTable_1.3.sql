ALTER TABLE categoria_gasto   
	DROP COLUMN id_conta, 
	DROP FOREIGN KEY fk_categoria_gasto_conta;


ALTER TABLE conta   
	CHANGE id_usuario id_usuario INT(11) NOT NULL;


ALTER TABLE categoria_gasto
	ADD id_usuario INT(11) NOT NULL;

/*se necessário rodar o update abaixo*/
UPDATE  categoria_gasto SET id_usuario = 1;

ALTER TABLE categoria_gasto  
  ADD CONSTRAINT fk_categoria_gasto_usuario 
  FOREIGN KEY (id_usuario) 
  REFERENCES usuario(id);

ALTER TABLE gasto
	ADD produto_adquirido VARCHAR(300) NULL;