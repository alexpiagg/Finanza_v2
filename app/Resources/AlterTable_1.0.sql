ALTER TABLE projecao_gasto
  DROP COLUMN excluido;

ALTER TABLE projecao_gasto
  DROP INDEX fk_projecao_gasto_conta,
  ADD  INDEX fk_conta_pagar_conta (id_conta);

ALTER TABLE projecao_gasto
  ADD CONSTRAINT fk_conta_pagar_conta FOREIGN KEY (id_conta) REFERENCES conta(id),
  DROP FOREIGN KEY fk_projecao_gasto_conta;

RENAME TABLE projecao_gasto TO conta_pagar;

