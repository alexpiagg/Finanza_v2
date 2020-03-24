ALTER TABLE gasto
  CHANGE id_tipo_gasto id_categoria_gasto INT(11) NULL;

ALTER TABLE categoria_gasto
  CHANGE tipo tipo VARCHAR(40) NOT NULL;

