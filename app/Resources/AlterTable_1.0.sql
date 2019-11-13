ALTER TABLE `dadosv2`.`projecao_gasto`   
  DROP COLUMN `excluido`;

ALTER TABLE `dadosv2`.`projecao_gasto`   
  DROP INDEX `fk_projecao_gasto_conta`,
  ADD  INDEX `fk_conta_pagar_conta` (`id_conta`);

ALTER TABLE `dadosv2`.`projecao_gasto` 
  ADD CONSTRAINT `fk_conta_pagar_conta` FOREIGN KEY (`id_conta`) REFERENCES `dadosv2`.`conta`(`id`),
  DROP FOREIGN KEY `fk_projecao_gasto_conta`;

RENAME TABLE `dadosv2`.`projecao_gasto` TO `dadosv2`.`conta_pagar`;

