/*Table structure for table conta */

DROP TABLE IF EXISTS conta;

CREATE TABLE conta (
  id int(11) NOT NULL AUTO_INCREMENT,
  conta varchar(30) NOT NULL,
  id_usuario int(1) NOT NULL,
  valor decimal(15,4) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY fk_conta_usuario (id_usuario),
  CONSTRAINT fk_conta_usuario FOREIGN KEY (id_usuario) REFERENCES usuario (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table gasto */

DROP TABLE IF EXISTS gasto;

CREATE TABLE gasto (
  id int(11) NOT NULL AUTO_INCREMENT,
  data date NOT NULL,
  local varchar(100) NOT NULL,
  valor decimal(15,4) DEFAULT NULL,
  id_tipo_gasto int(11) DEFAULT NULL,
  id_conta int(11) DEFAULT NULL,
  cartao_credito int(1) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY fk_gasto_tipo_gasto (id_tipo_gasto),
  KEY fk_gasto_conta (id_conta),
  CONSTRAINT fk_gasto_conta FOREIGN KEY (id_conta) REFERENCES conta (id),
  CONSTRAINT fk_gasto_tipo_gasto FOREIGN KEY (id_tipo_gasto) REFERENCES tipo_gasto (id)
) ENGINE=InnoDB AUTO_INCREMENT=8956 DEFAULT CHARSET=utf8;

/*Table structure for table projecao_gasto */

DROP TABLE IF EXISTS projecao_gasto;

CREATE TABLE projecao_gasto (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(100) DEFAULT NULL,
  valor decimal(15,4) DEFAULT NULL,
  quantidade int(11) DEFAULT NULL,
  id_conta int(11) DEFAULT NULL,
  data_vencto date NULL,
  PRIMARY KEY (id),
  KEY fk_projecao_gasto_conta (id_conta),
  CONSTRAINT fk_projecao_gasto_conta FOREIGN KEY (id_conta) REFERENCES conta (id)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table receita */

DROP TABLE IF EXISTS receita;

CREATE TABLE receita (
  id int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(100) DEFAULT NULL,
  valor decimal(15,4) DEFAULT NULL,
  data date NOT NULL,
  id_conta int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY fk_receita_conta (id_conta),
  CONSTRAINT fk_receita_conta FOREIGN KEY (id_conta) REFERENCES conta (id)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

/*Table structure for table tipo_gasto */

DROP TABLE IF EXISTS tipo_gasto;

CREATE TABLE tipo_gasto (
  id int(11) NOT NULL AUTO_INCREMENT,
  tipo varchar(20) NOT NULL,
  excluido int(1) DEFAULT NULL,
  id_conta int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY fk_tipo_gasto_conta (id_conta),
  CONSTRAINT fk_tipo_gasto_conta FOREIGN KEY (id_conta) REFERENCES conta (id)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table usuario */

DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome_completo varchar(80) DEFAULT NULL,
  email varchar(100) NOT NULL,
  excluido int(1) DEFAULT NULL,
  senha varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;