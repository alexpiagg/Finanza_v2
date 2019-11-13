ALTER TABLE tipo_gasto   
  DROP INDEX fk_tipo_gasto_conta,
  ADD  INDEX fk_categoria_gasto_conta (id_conta);

ALTER TABLE tipo_gasto 
  ADD CONSTRAINT fk_categoria_gasto_conta FOREIGN KEY (id_conta) REFERENCES conta(id),
  DROP FOREIGN KEY fk_tipo_gasto_conta;

RENAME TABLE tipo_gasto TO categoria_gasto;

ALTER TABLE gasto   
  DROP INDEX fk_gasto_tipo_gasto,
  ADD  INDEX fk_gasto_categoria_gasto (id_tipo_gasto);

ALTER TABLE gasto 
  ADD CONSTRAINT fk_gasto_fk_gasto_categoria_gasto FOREIGN KEY (id_tipo_gasto) REFERENCES categoria_gasto(id),
  DROP FOREIGN KEY fk_gasto_tipo_gasto;
