CREATE TABLE professores (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  matricula VARCHAR(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE processador (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE softwares (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  versao VARCHAR(100) NOT NULL,
  tipo INT NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  login VARCHAR(50) NOT NULL,
  senha VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  nivel INT NOT NULL DEFAULT 1,
  situacao INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);

CREATE TABLE turnos (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE placa_de_video (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE memoria (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE aulas (
  id INT NOT NULL AUTO_INCREMENT,
  turnos_id INT NOT NULL,
  hora_inicio TIME NOT NULL,
  hora_fim TIME NOT NULL,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY(id),
  INDEX IX_AULAS_TURNOS_ID(turnos_id),
  FOREIGN KEY(turnos_id)
    REFERENCES turnos(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE hardwares (
  id INT NOT NULL AUTO_INCREMENT,
  placa_de_video_id INT NOT NULL,
  memoria_id INT NOT NULL,
  processador_id INT NOT NULL,
  PRIMARY KEY(id),
  INDEX IX_HARDWARES_PROCESSADOR_ID(processador_id),
  INDEX IX_HARDWARES_MEMORIA_ID(memoria_id),
  INDEX IX_HARDWARES_PLACA_DE_VIDEO_ID(placa_de_video_id),
  FOREIGN KEY(processador_id)
    REFERENCES processador(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(memoria_id)
    REFERENCES memoria(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(placa_de_video_id)
    REFERENCES placa_de_video(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE laboratorios (
  id INT NOT NULL AUTO_INCREMENT,
  hardwares_id INT NOT NULL,
  nome VARCHAR(45) NOT NULL,
  capacidade INT NOT NULL,
  situacao INT NOT NULL,
  PRIMARY KEY(id),
  INDEX IX_LABORATORIOS_HARDWARES_ID(hardwares_id),
  FOREIGN KEY(hardwares_id)
    REFERENCES hardwares(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE laboratorios_softwares (
  laboratorios_id INT NOT NULL,
  softwares_id INT NOT NULL,
  PRIMARY KEY(laboratorios_id, softwares_id),
  INDEX IX_LABORATORIOS_SOFTWARES_LABORATORIOS_ID(laboratorios_id),
  INDEX IX_LABORATORIOS_SOFTWARES_SOFTWARES_ID(softwares_id),
  UNIQUE INDEX UQ_LABORATORIOS_SOFTWARES_LABORATORIOS_SOFTWARES_ID(laboratorios_id, softwares_id),
  FOREIGN KEY(laboratorios_id)
    REFERENCES laboratorios(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(softwares_id)
    REFERENCES softwares(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE reservas (
  id INT NOT NULL AUTO_INCREMENT,
  professores_id INT NOT NULL,
  laboratorios_id INT NOT NULL,
  usuarios_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  color VARCHAR(10) NOT NULL,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL,
  situacao INT NOT NULL DEFAULT 0,
  PRIMARY KEY(id),
  INDEX IX_RESERVAS_USUARIOS_ID(usuarios_id),
  INDEX IX_RESERVAS_LABORATORIOS_ID(laboratorios_id),
  INDEX IX_RESERVAS_PROFESSORES_ID(professores_id),
  FOREIGN KEY(usuarios_id)
    REFERENCES usuarios(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(laboratorios_id)
    REFERENCES laboratorios(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(professores_id)
    REFERENCES professores(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE reservas_aulas (
  id INT NOT NULL AUTO_INCREMENT,
  aulas_id INT NOT NULL,
  reservas_id INT NOT NULL,
  PRIMARY KEY(id),
  INDEX IX_RESERVAS_AULAS_RESERVAS_ID(reservas_id),
  INDEX IX_RESERVAS_AULAS_AULAS_ID(aulas_id),
  FOREIGN KEY(reservas_id)
    REFERENCES reservas(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(aulas_id)
    REFERENCES aulas(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


