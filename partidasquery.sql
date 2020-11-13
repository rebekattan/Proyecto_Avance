CREATE TABLE tipoPartidas(
codTipoPartidas int NOT NULL AUTO_INCREMENT,
nombre VARCHAR(60) NOT NULL,
PRIMARY KEY (codTipoPartidas)
);

CREATE TABLE Partidas(
codPartidas int NOT NULL AUTO_INCREMENT,
fecha date NOT NULL,
numCorrelativo int NOT NULL,
codTipoPartidas int NOT NULL,
FOREIGN KEY (codTipoPartidas) REFERENCES tipoPartidas(codTipoPartidas),
PRIMARY KEY (codPartidas)
);

CREATE TABLE tipoCuentas(
codTipoCuentas int NOT NULL AUTO_INCREMENT,
nombre VARCHAR(60) NOT NULL,
PRIMARY KEY (codTipoCuentas)
);

CREATE TABLE cuentas(
codCuentas int NOT NULL AUTO_INCREMENT,
numCuentas varchar(25) NOT NULL,
nombreCuentas varchar(50) NOT NULL,
codTipoCuentas int NOT NULL,
FOREIGN KEY (codTipoCuentas) REFERENCES tipoCuentas(codTipoCuentas),
PRIMARY KEY (codCuentas)
);

CREATE TABLE partidasCuentas(
codPartidasCuentas int NOT NULL AUTO_INCREMENT,
codPartidas int NOT NULL,
codCuentas int NOT NULL,
FOREIGN KEY (codPartidas) REFERENCES partidas(codPartidas),
FOREIGN KEY (codCuentas) REFERENCES cuentas(codCuentas),
PRIMARY KEY (codPartidasCuentas)
);

CREATE TABLE estatus(
codEstatus int NOT NULL AUTO_INCREMENT,
nombreEstatus VARCHAR(60) NOT NULL,
PRIMARY KEY (codEstatus)
);

CREATE TABLE partidaDetalle(
codPartidaDet int NOT NULL AUTO_INCREMENT,
codPartidasCuentas int NOT NULL,
debe VARCHAR(60) NOT NULL,
haber VARCHAR(60) NOT NULL,
codEstatus int NOT NULL,
FOREIGN KEY (codPartidasCuentas) REFERENCES partidasCuentas(codPartidasCuentas),
FOREIGN KEY (codEstatus) REFERENCES estatus(codEstatus),
PRIMARY KEY (codPartidaDet)
);
