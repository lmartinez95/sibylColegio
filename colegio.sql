CREATE DATABASE IF NOT EXISTS sibylColegio;
USE sibylColegio;

CREATE TABLE IF NOT EXISTS Colegio(
	clgId INTEGER AUTO_INCREMENT PRIMARY KEY,
	clgNombre VARCHAR(75) NOT NULL,
	clgDireccion VARCHAR(250),
	clgTelefono VARCHAR(15),
	clgFax VARCHAR(15),
	clgEmail VARCHAR(75)
);

CREATE TABLE IF NOT EXISTS Departamento(
	dptId INTEGER AUTO_INCREMENT PRIMARY KEY,
    dptCodigo VARCHAR(10), CONSTRAINT UQ_dptCodigo UNIQUE (dptCodigo),
    dptNombre VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Municipio(
	munId INTEGER AUTO_INCREMENT PRIMARY KEY,
    munCodigo VARCHAR(10), CONSTRAINT UQ_munCodigo UNIQUE (munCodigo),
    munNombre VARCHAR(150) NOT NULL,
    munCodPostal VARCHAR(10),
    dptId INTEGER, CONSTRAINT FK_Departamento_Municipio FOREIGN KEY(dptId) REFERENCES Departamento(dptId)
);

-- Empleado, pero no necesariamente posee cuenta en el sistema
CREATE TABLE IF NOT EXISTS TipoEmpleado(
	tempId INTEGER AUTO_INCREMENT PRIMARY KEY,
	tempCodigo VARCHAR(8), CONSTRAINT UQ_tempCodigo UNIQUE (tempCodigo),
	tempNombre VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Empleado(
	empId INTEGER AUTO_INCREMENT PRIMARY KEY,
	empCodigo VARCHAR(8), CONSTRAINT UQ_empCodigo UNIQUE (empCodigo),
	empNombre VARCHAR(50) NOT NULL,
	empApellidoP VARCHAR(25) NOT NULL,
	empApellidoM VARCHAR(25),
	empSexo CHAR(1),
	empDUI VARCHAR(10),
	empNIT VARCHAR(20),
	empISSS VARCHAR(20),
	empNUP VARCHAR(20),
	empDireccion VARCHAR(400),
	empTelCasa VARCHAR(15),
	empCelular VARCHAR(15),
	empEmail VARCHAR(100),
	tempId INTEGER, CONSTRAINT FK_TipoEmpleado_Empleado FOREIGN KEY(tempId) REFERENCES TipoEmpleado(tempId),
	empFechaIngreso DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	empFechaSalida DATE,
	empActivo BIT DEFAULT 1 NOT NULL,
	empFechaNac DATE,
	empProfesion VARCHAR(250)
);


-- Kinder a Bachillerato
CREATE TABLE IF NOT EXISTS Nivel(
	nvlId INTEGER AUTO_INCREMENT PRIMARY KEY,
	nvlAbrev VARCHAR(10),
	nvlNivel VARCHAR(25),
	nvlIdPadre INTEGER, CONSTRAINT FK_Nivel_Nivel FOREIGN KEY(nvlIdPadre) REFERENCES Nivel(nvlId)
);

CREATE TABLE IF NOT EXISTS Turno(
	turId INTEGER AUTO_INCREMENT PRIMARY KEY,
	turNombre VARCHAR(25),
	turActivo BIT DEFAULT 0
);


CREATE TABLE Materia(
	matId INTEGER AUTO_INCREMENT PRIMARY KEY,
	matCodigo VARCHAR(15),
	matNombre VARCHAR(50)
);

-- Nivel, turno y docente guía
CREATE TABLE Grado(
	grdId INTEGER AUTO_INCREMENT PRIMARY KEY,
	grdNombre VARCHAR(50),
	turId INTEGER, CONSTRAINT FK_Turno_Grado FOREIGN KEY(turId) REFERENCES Turno(turId),
	empId INTEGER, CONSTRAINT FK_Empleado_Grado FOREIGN KEY(empId) REFERENCES Empleado(empId),
	nvlId INTEGER, CONSTRAINT FK_Nivel_Grado FOREIGN KEY(nvlId) REFERENCES Nivel(nvlId)
);

CREATE TABLE IF NOT EXISTS Alumno(
	almId INTEGER AUTO_INCREMENT PRIMARY KEY,
	almCodigo VARCHAR(8), CONSTRAINT UQ_almCodigo UNIQUE (almCodigo),
	almNie VARCHAR(8), CONSTRAINT UQ_almNie UNIQUE (almNie),
	almNombre VARCHAR(50) NOT NULL,
	almApellidoP VARCHAR(25) NOT NULL,
	almApellidoM VARCHAR(25),
	almFechaNac DATE NOT NULL,
	almLugarNac VARCHAR(100),
	almSexo CHAR(1) NOT NULL,
	almDireccion VARCHAR(400),
	dptId INTEGER, CONSTRAINT FK_Departamento_Alumno FOREIGN KEY(dptId) REFERENCES Departamento(dptId),
	munId INTEGER, CONSTRAINT FK_Municipio_Alumno FOREIGN KEY(munId) REFERENCES Municipio(munId),
	almMadre VARCHAR(100),
	almMadreDui VARCHAR(10),
	almPadre VARCHAR(100),
	almPadreDui VARCHAR(10),
	almTelCasa VARCHAR(15),
	almTelCel VARCHAR(15),
	almCorreo VARCHAR(50),
	almResponsable VARCHAR(50),
	almTelResponsable VARCHAR(15),
	almFoto VARCHAR(100)
);


CREATE TABLE IF NOT EXISTS Grupo( -- Para DocenteMateria
	grpId INTEGER AUTO_INCREMENT PRIMARY KEY,
	empId INTEGER, CONSTRAINT FK_Empleado_Grupo FOREIGN KEY(empId) REFERENCES Empleado(empId),
	matId INTEGER, CONSTRAINT FK_Materia_Grupo FOREIGN KEY(matId) REFERENCES Materia(matId),
	grdId INTEGER, CONSTRAINT FK_Grado_Grupo FOREIGN KEY(grdId) REFERENCES Grado(grdId)
);

-- Alumnos en ese grupo
CREATE TABLE detGrupo(
	dgrpId INTEGER AUTO_INCREMENT PRIMARY KEY,
	grpId INTEGER, CONSTRAINT FK_Grupo_DetalleGRupo FOREIGN KEY(grpId) REFERENCES Grupo(grpId),
	almId INTEGER, CONSTRAINT FK_Alumno_DetalleGrupo FOREIGN KEY(almId) REFERENCES Alumno(almId)
);

CREATE TABLE IF NOT EXISTS Periodo(
	perId INT AUTO_INCREMENT PRIMARY KEY,
    perNombre INT,
    perFechaInicio DATE,
    perFechaFin DATE
);

CREATE TABLE IF NOT EXISTS TipoEvaluacion(
	tevaId INTEGER AUTO_INCREMENT PRIMARY KEY,
    tevaNombre VARCHAR(150)
);

CREATE TABLE IF NOT EXISTS Evaluacion(
	evaId INTEGER AUTO_INCREMENT PRIMARY KEY,
	evaNombre VARCHAR(50),
	evaPorcentaje FLOAT, CONSTRAINT CHK_evaPorcentaje CHECK (notPorcentaje1 >= 0.0 AND notPorcentaje1 <= 1.0),
	grpId INTEGER, CONSTRAINT FK_Grupo_Evaluacion FOREIGN KEY(grpId) REFERENCES Grupo(grpId),
    perId INT, CONSTRAINT FK_Periodo_Evaluacion FOREIGN KEY(perId) REFERENCES Periodo(perId),
    anio INT
);

CREATE TABLE IF NOT EXISTS Nota(
	notId INTEGER AUTO_INCREMENT PRIMARY KEY,
	notNota FLOAT, CONSTRAINT CHK_notNota CHECK (notNota >= 0.0 AND notNota <= 10.0),
	notPorcentaje FLOAT, CONSTRAINT CHK_notPorcentaje1 CHECK (notPorcentaje1 >= 0.0 AND notPorcentaje1 <= 1.0),
	notTot FLOAT AS (notNota * notPorcentaje),
	evaId INTEGER, CONSTRAINT FK_Evaluacion_Notas FOREIGN KEY(evaId) REFERENCES Evaluacion(evaId),
	almId INTEGER, CONSTRAINT FK_Alumno_Notas FOREIGN KEY(almId) REFERENCES Alumno(almId),
	grpId INTEGER, CONSTRAINT FK_Grupo_Notas FOREIGN KEY(grpId) REFERENCES Grupo(grpId),
    notPost BIT DEFAULT 0 -- Nota publicada y no puede ser modificada, sin una autoridad
);


CREATE TABLE IF NOT EXISTS HistorialNota(
	hnotId INTEGER AUTO_INCREMENT PRIMARY KEY,
	nvlNombre VARCHAR(25),
	matNombre VARCHAR(50),
	notNota FLOAT, CONSTRAINT CHK_notNota CHECK (notNota >= 0.0 AND notNota <= 10.0),
    hnotPeriodo INT,
    hnotAnio INT,
	almId INTEGER, CONSTRAINT FK_Alumno_Notas FOREIGN KEY(almId) REFERENCES Alumno(almId)
);

CREATE TABLE IF NOT EXISTS Rol(
rolId INTEGER AUTO_INCREMENT PRIMARY KEY,
rolNombre VARCHAR(50),
rolRedirect VARCHAR(15)
);

CREATE TABLE IF NOT EXISTS Acceso(
accId INTEGER AUTO_INCREMENT PRIMARY KEY,
accCodigo VARCHAR(15), CONSTRAINT UQ_accCodigo UNIQUE (accCodigo),
accVista VARCHAR(25),
accDescripcion VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS RolAcceso(
raccId INTEGER AUTO_INCREMENT PRIMARY KEY,
rolId INTEGER, CONSTRAINT FK_Rol_RolAcceso FOREIGN KEY(rolId) REFERENCES Rol(rolId),
accId INTEGER, CONSTRAINT FK_Acceso_RolAcceso FOREIGN KEY(accId) REFERENCES Acceso(accId)
);

CREATE TABLE IF NOT EXISTS Usuario(
usrId INTEGER AUTO_INCREMENT PRIMARY KEY,
usrUsuario VARCHAR(8), CONSTRAINT UQ_usrUsuario UNIQUE (usrUsuario),
usrNombre VARCHAR(50),
usrPassword VARCHAR(64),
rolId INTEGER, CONSTRAINT FK_Rol_Usuario FOREIGN KEY(rolId) REFERENCES Rol(rolId),
empId INTEGER DEFAULT NULL,
almId INTEGER DEFAULT NULL
);

-- ----------------------------------------------Llenando tablas iniciales -- ----------------------------------------------

INSERT INTO Departamento(dptCodigo,dptNombre) VALUES('01-AH','Ahuachapán'),('02-CA','Cabañas'),('03-CH','Chalatenango'),('04-CU','Cuscatlán'),('05-LI','La Libertad'),('06-PA','La Paz'),
('07-UN','La Unión'),('08-MO','Morazán'),('09-SM','San Miguel'),('10-SS','San Salvador'),('11-SV','San Vicente'),('12-SA','Santa Ana'),('13-SO','Sonsonate'),('14-US','Usulután');

INSERT INTO Municipio(munCodigo,munNombre,munCodPostal,dptId) VALUES
('01-01','Ahuachapán','CP 2101',1),('01-02','Apaneca','CP 2102',1),('01-03','Atiquizaya','CP 2103',1),('01-04','Concepción de Ataco','CP 2106',1),('01-05','El Refugio','CP 2107',1),('01-06','Guaymango','CP 2108',1),
('01-07','Jujutla','CP 2109',1),('01-08','San Francisco Menéndez','CP 2113',1),('01-09','San Lorenzo','CP 2115',1),('01-10','San Pedro Puxtla','CP 2116',1),('01-11','Tacuba','CP 2117',1),('01-12','Turín','CP 2118',1),
('02-01','Cinquera','CP 1202',2),('02-02','Dolores','CP 1209',2),('02-03','Guacotecti','CP 1203',2),('02-04','Ilobasco','CP 1204',2),('02-05','Jutiapa','CP 1206',2),('02-06','San Isidro','CP 1207',2),
('02-07','Sensuntepeque','CP 1201',2),('02-08','Tejutepeque','CP 1209',2),('02-09','Victoria','CP 1210',2),
('03-01','Agua Caliente','CP 1302',3),('03-02','Arcatao','CP 1303',3),('03-03','Azacualpa','CP 1304',3),('03-04','Chalatenango','CP 1301',3),('03-05','Citalá','CP 1306',3),('03-06','Comalapa','CP 1307',3),
('03-07','Concepción Quezaltepeque','CP 1308',3),('03-08','Dulce Nombre de María','CP 1309',3),('03-09','El Carrizal','CP 1311',3),('03-10','El Paraíso','CP 1312',3),('03-11','La Laguna','CP 1313',3),
('03-12','La Palma','CP 1314',3),('03-13','La Reina','CP 1315',3),('03-14','Las Vueltas','CP 1317',3),('03-15','Nombre de Jesús','CP 1319',3),('03-16','Nueva Concepción','CP 1320',3),('03-17','Nueva Trinidad','CP 1320',3),
('03-18','Ojos de Agua','CP 1321',3),('03-19','Potonico','CP 1322',3),('03-20','San Antonio de la Cruz','CP 1324',3),('03-21','San Antonio Los Ranchos','CP 1325',3),('03-22','San Fernando','CP 1326',3),
('03-23','San Francisco Lempa','CP 1327',3),('03-24','San Francisco Morazán','CP 1328',3),('03-25','San Ignacio','CP 1329',3),('03-26','San Isidro Labrador','CP 1330',3),('03-27','San José Cancasque','CP 1305',3),
('03-28','San José Las Flores','CP 1316',3),('03-29','San Luis del Carmen','CP 1331',3),('03-30','San Miguel de Mercedes','CP 1332',3),('03-31','San Rafael','CP 1333',3),('03-32','Santa Rita','CP 1334',3),
('03-33','Tejutla','CP 1335',3),
('04-01','Candelaria','CP 1402',4),('04-02','Cojutepeque','CP 1401',4),('04-03','El Carmen','CP 1403',4),('04-04','El Rosario','CP 1404',4),('04-05','Monte San Juan','CP 1405',4),('04-06','Oratorio de Concepción','CP 1406',4),
('04-07','San Bartolomé Perulapía','CP 1407',4),('04-08','San Cristóbal','CP 1408',4),('04-09','San José Guayabal','CP 1409',4),('04-10','San Pedro Perulapán','CP 1410',4),('04-11','San Rafael Cedros','CP 1411',4),
('04-12','San Ramón','CP 1412',4),('04-13','Santa Cruz Analquito','CP 1413',4),('04-14','Santa Cruz Michapa','CP 1414',4),('04-15','Suchitoto','CP 1415',4),('04-16','Tenancingo','CP 1416',4),
('05-01','Antiguo Cuscatlán','CP 1502',5),('05-02','Chiltiupán','CP 1507',5),('05-03','Ciudad Arce','CP 1504',5),('05-04','Colón','CP 1512',5),('05-05','Comasagua','CP 1506',5),('05-06','Huizúcar','CP 1508',5),
('05-07','Jayaque','CP 1509',5),('05-08','Jicalapa','CP 1510',5),('05-09','La Libertad','CP 1511',5),('05-10','Nuevo Cuscatlán','CP 1513',5),('05-11','Quezaltepeque','CP 1515',5),('05-12','Sacacoyo','CP 1516',5),
('05-13','San José Villanueva','CP 1517',5),('05-14','San Juan Opico','CP 1514',5),('05-15','San Matías','CP 1518',5),('05-16','San Pablo Tacachico','CP 1519',5),('05-17','Santa Tecla','CP 1501',5),('05-18','Talnique','CP 1521',5),
('05-19','Tamanique','CP 1522',5),('05-20','Teotepeque','CP 1523',5),('05-21','Tepecoyo','CP 1524',5),('05-22','Zaragoza','CP 1525',5),
('06-01','Cuyultitán','CP 1603',6),('06-02','El Rosario','CP 1604',6),('06-03','Jerusalén','CP 1605',6),('06-04','Mercedes La Ceiba','CP 1607',6),('06-05','Olocuilta','CP 1608',6),('06-06','Paraíso de Osorio','CP 1609',6),
('06-07','San Antonio Masahuat','CP 1610',6),('06-08','San Emigdio','CP 1611',6),('06-09','San Francisco Chinameca','CP 1612',6),('06-10','San Juan Nonualco','CP 1613',6),('06-11','San Juan Talpa','CP 1614',6),
('06-12','San Juan Tepezontes','CP 1615',6),('06-13','San Luis La Herradura','CP 1616',6),('06-14','San Luis Talpa','CP 1616',6),('06-15','San Miguel Tepezontes','CP 1617',6),('06-16','San Pedro Masahuat','CP 1618',6),
('06-17','San Pedro Nonualco','CP 1619',6),('06-18','San Rafael Obrajuelo','CP 1620',6),('06-19','Santa María Ostuma','CP 1621',6),('06-20','Santiago Nonualco','CP 1622',6),('06-21','Tapalhuaca','CP 1623',6),
('06-22','Zacatecoluca','CP 1601',6),
('07-01','Anamorós','CP 3104',7),('07-02','Bolívar','CP 3105',7),('07-03','Concepción de Oriente','CP 3106',7),('07-04','Conchagua','CP 3107',7),('07-05','El Carmen','CP 3108',7),('07-06','El Sauce','CP 3109',7),
('07-07','Intipucá','CP 3111',7),('07-08','La Unión','CP 3101',7),('07-09','Lislique','CP 3112',7),('07-10','Meanguera del Golfo','CP 3113',7),('07-11','Nueva Esparta','CP 3114',7),('07-12','Pasaquina','CP 3116',7),
('07-13','Polorós','CP 3117',7),('07-14','San Alejo','CP 3119',7),('07-15','San José de La Fuente','CP 3120',7),('07-16','Santa Rosa de Lima','CP 3121',7),('07-17','Yayantique','CP 3122',7),('07-18','Yucuaiquín','CP 3123',7),
('08-01','Arambala','CP 3202',8),('08-02','Cacaopera','CP 3203',8),('08-03','Chilanga','CP 3205',8),('08-04','Corinto','CP 3204',8),('08-05','Delicias de Concepción','CP 3206',8),('08-06','El Divisadero','CP 3207',8),
('08-07','El Rosario','CP 3207',8),('08-08','Gualococti','CP 3209',8),('08-09','Guatajiagua','CP 3210',8),('08-10','Joateca','CP 3211',8),('08-11','Jocoaitique','CP 3212',8),('08-12','Jocoro','CP 3213',8),('08-13','Lolotiquillo','CP 3214',8),
('08-14','Meanguera','CP 3215',8),('08-15','Osicala','CP 3216',8),('08-16','Perquín','CP 3217',8),('08-17','San Carlos','CP 3218',8),('08-18','San Fernando','CP 3219',8),('08-19','San Francisco Gotera','CP 3201',8),('08-20','San Isidro','CP 3220',8),
('08-21','San Simón','CP 3221',8),('08-22','Sensembra','CP 3222',8),('08-23','Sociedad','CP 3223',8),('08-24','Torola','CP 3224',8),('08-25','Yamabal','CP 3225',8),('08-26','Yoloaiquín','CP 3226',8),
('09-01','Carolina','CP 3302',9),('09-02','Chapeltique','CP 3305',9),('09-03','Chinameca','CP 3306',9),('09-04','Chirilagua','CP 3307',9),('09-05','Ciudad Barrios','CP 3303',9),('09-06','Comacarán','CP 3304',9),
('09-07','El Tránsito','CP 3309',9),('09-08','Lolotique','CP 3311',9),('09-09','Moncagua','CP 3312',9),('09-10','Nueva Guadalupe','CP 3313',9),('09-11','Nuevo Edén de San Juan','CP 3314',9),('09-12','Quelepa','CP 3315',9),
('09-13','San Antonio del Mosco','CP 3316',9),('09-14','San Gerardo','CP 3318',9),('09-15','San Jorge','CP 3319',9),('09-16','San Luis de la Reina','CP 3320',9),('09-17','San Miguel','CP 3301',9),
('09-18','San Rafael Oriente','CP 3322',9),('09-19','Sesori','CP 3323',9),('09-20','Uluazapa','CP 3324',9),
('10-01','Aguilares','CP 1122',10),('10-02','Apopa','CP 1123',10),('10-03','Ayutuxtepeque','CP 1121',10),('10-04','Ciudad Delgado','CP 1118',10),('10-05','Cuscatancingo','CP 1119',10),('10-06','El Paisnal','1124',10),
('10-07','Guazapa','CP 1125',10),('10-08','Ilopango','CP 1117',10),('10-09','Mejicanos','CP 1120',10),('10-10','Nejapa','CP 1126',10),('10-11','Panchimalco','CP 1127',10),('10-12','Rosario de Mora','CP 1128',10),('10-13','San Marcos','CP 1115',10),
('10-14','San Martín','CP 1129',10),('10-15','San Salvador','CP 1101',10),('10-16','Santiago Texacuangos','CP 1130',10),('10-17','Santo Tomás','CP 1131',10),('10-18','Soyapango','CP 1116',10),('10-19','Tonacatepeque','CP 1132',10),
('11-01','Apastepeque','CP 1702',11),('11-02','Guadalupe','CP 1703',11),('11-03','San Cayetano Istepeque','CP 1704',11),('11-04','San Esteban Catarina','CP 1705',11),('11-05','San Ildefonso','CP 1706',11),
('11-06','San Lorenzo','CP 1707',11),('11-07','San Sebastián','CP 1708',11),('11-08','San Vicente','CP 1701',11),('11-09','Santa Clara','CP 1709',11),('11-10','Santo Domingo','CP 1710',11),('11-11','Tecoluca','CP 1711',11),
('11-12','Tepetitán','CP 1712',11),('11-13','Verapaz','CP 1713',11),
('12-01','Candelaria de la Frontera','CP 2203',12),('12-02','Chalchuapa','CP 2205',12),('12-03','Coatepeque','CP 2204',12),('12-04','El Congo','CP 2207',12),('12-05','El Porvenir','CP 2208',12),('12-06','Masahuat','CP 2210',12),
('12-07','Metapán','CP 2211',12),('12-08','San Antonio Pajonal','CP 2212',12),('12-09','San Sebastián Salitrillo','CP 2215',12),('12-10','Santa Ana','CP 2201',12),('12-11','Santa Rosa Guachipilín','CP 2216',12),
('12-12','Santiago de la Frontera','CP 2217',12),('12-13','Texistepeque','CP 2218',12),
('13-01','Acajutla','CP 2302',13),('13-02','Armenia','CP 2303',13),('13-03','Caluco','CP 2304',13),('13-04','Cuisnahuat','CP 2305',13),('13-05','Izalco','CP 2306',13),('13-06','Juayúa','CP 2307',13),('13-07','Nahuizalco','CP 2311',13),
('13-08','Nahulingo','CP 2312',13),('13-09','Salcoatitán','CP 2313',13),('13-10','San Antonio del Monte','CP 2314',13),('13-11','San Julián','CP 2316',13),('13-12','Santa Catarina Masahuat','CP 2317',13),
('13-13','Santa Isabel Ishuatán','CP 2317',13),('13-14','Santo Domingo Guzmán','CP 2319',13),('13-15','Sonsonate','CP 2301',13),('13-16','Sonzacate','CP 2320',13),
('14-01','Alegría','CP 3404',14),('14-02','Berlín','CP 3403',14),('14-03','California','CP 3404',14),('14-04','Concepción Batres','CP 3405',14),('14-05','El Triunfo','CP 3406',14),('14-06','Ereguayquín','CP 3407',14),
('14-07','Estanzuelas','CP 3408',14),('14-08','Jiquilisco','CP 3409',14),('14-09','Jucuapa','CP 3410',14),('14-10','Jucuarán','CP 3411',14),('14-11','Mercedes Umaña','CP 3412',14),('14-12','Nueva Granada','CP 3413',14),
('14-13','Ozatlán','CP 3415',14),('14-14','Puerto El Triunfo','CP 3417',14),('14-15','San Agustín','CP 3418',14),('14-16','San Buenaventura','CP 3419',14),('14-17','San Dionisio','CP 3420',14),('14-18','San Francisco Javier','CP 3421',14),
('14-19','Santa Elena','CP 3422',14),('14-20','Santa María','CP 3423',14),('14-21','Santiago de María','CP 3424',14),('14-22','Tecapán','CP 3426',14),('14-23','Usulután','CP 3401',14);

INSERT INTO Turno(turNombre,turActivo) VALUES('Matutino',1),('Vespertino',1),('Nocturno',1);

INSERT INTO TipoEvaluacion(tevaNombre) VALUES('Examen corto'),('Actividad integradora'),('Trabajo grupal'),('Caso de estudio'),('Parcial');

INSERT INTO Rol(rolNombre,rolRedirect) VALUES('Administrador','admin'),('Alumno','alumno'),('Docente','docente');
INSERT INTO Acceso(accCodigo,accVista)
VALUES('dashAdmin','Panel de administración'),('dashAlumno','Panel alumno'),('dashDocente','Panel docente'),
('menuPersonal','Menu personal'),('verTipoEmpleado','Tipo empleados'),('verEmpleado','Empleados'),('nuevoEmpleado','Agregar empleado'),
('menuPedagogico','Menu Pedagogico'),('verMateria','Materias'),('verNivel','Niveles'),('verGrado','Grados'),('verGrupo','Grupos'),
('menuAlumnos','Menu alumnos'),('verAlumno','Alumnos'),('matricula','Matricula'),
('notas','Notas'),('expediente','Expediente');

INSERT INTO RolAcceso(rolId,accId) VALUES(1,1),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),
(2,2),(2,16),(2,17),(3,3);

INSERT INTO Usuario VALUES(null,'admin','Administrador','240BE518FABD2724DDB6F04EEB1DA5967448D7E831C08C8FA822809F74C720A9',NULL,1,null);
-- admin, admin123

#-------------------------------------Consultas---------------------------------------------------
-- Login
SELECT u.rolId,u.usrNombre,u.empId,r.rolRedirect,u.almId FROM Usuario u
INNER JOIN Rol r ON u.rolId = r.rolId
WHERE u.usrUsuario = 'admin' AND u.usrPassword = '240BE518FABD2724DDB6F04EEB1DA5967448D7E831C08C8FA822809F74C720A9';

-- Accesos
SELECT * FROM RolAcceso;

SELECT DISTINCT a.accCodigo FROM RolAcceso ra
INNER JOIN Rol r ON ra.rolId = r.rolId
INNER JOIN Acceso a ON ra.accId = a.accId
INNER JOIN Usuario u ON u.rolId = r.rolId
WHERE ra.rolId = 3;

-- Grupos (Dashboard de docentes)

SELECT g.grpId,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) AS Empleado,m.matNombre,gr.grdNombre,t.turNombre FROM Grupo g
INNER JOIN Empleado e ON g.empId = e.empId
INNER JOIN Materia m ON g.matId = m.matId
INNER JOIN Grado gr ON g.grdId = gr.grdId
INNER JOIN Turno t ON gr.turId = t.turId
WHERE g.empId = 2;

SELECT g.grpId,m.matNombre,gr.grdNombre,t.turNombre FROM Grupo g
INNER JOIN Empleado e ON g.empId = e.empId
INNER JOIN Materia m ON g.matId = m.matId
INNER JOIN Grado gr ON g.grdId = gr.grdId
INNER JOIN Turno t ON gr.turId = t.turId
WHERE g.empId = 2;

-- Empleados
SELECT e.empCodigo,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) as Nombre,
CASE e.empSexo WHEN 'M' THEN 'Masculino' ELSE 'Femenino' END AS Sexo,e.empDUI,te.tempNombre
FROM Empleado e INNER JOIN TipoEmpleado te ON e.tempId = te.tempId;

-- Listado de grupos
SELECT a.almId,a.almCodigo,CONCAT(a.almNombre,' ',a.almApellidoP,' ',a.almApellidoM) as Nombre FROM Alumno a
JOIN detGrupo dg ON dg.almId = a.almId
WHERE dg.grpId = 1;

-- Listado de evaluaciones por grupo
SELECT evaId,evaNombre,evaPorcentaje FROM Evaluacion
WHERE grpId = 1;

-- Total de evaluaciones
SELECT ROUND(SUM(evaPorcentaje),2) AS suma FROM Evaluacion
WHERE grpId = 1;

-- Listado de alumnos por grupo
SELECT COUNT(empId) AS cantidad
FROM Grupo g
WHERE empId = 2 AND grpId = 4;

SELECT a.almId,a.almCodigo,CONCAT(a.almApellidoP,' ',a.almApellidoM,' ', a.almNombre) as Nombre
FROM Alumno a
INNER JOIN detGrupo dg ON dg.almId = a.almId
WHERE dg.grpId = 2;

-- insert into Nota (notNota, notPorcentaje, evaId, almId, grpId)
select 3, 0.25, 1, 3, 1;

-- Listado de notas por grupo y evaluacion
SELECT G.grpId, D.dgrpId, A.almCodigo,A.almId, CONCAT(a.almNombre,' ', a.almApellidoP,' ',a.almApellidoM) AS Nombre, E.evaId, e.evaNombre,
	CASE WHEN n.notId IS NULL THEN 0 ELSE n.notId END AS notId,
	CASE WHEN n.notNota IS NULL THEN 0 ELSE n.notNota END AS nota
FROM Grupo G
	JOIN detGrupo D on (G.grdId=D.grpId)
	JOIN Alumno A on (D.almId=A.almId)
	JOIN Evaluacion E on (G.grpId=E.grpId)
    LEFT JOIN Nota N on (N.evaId=E.evaId and N.almId=A.almId and N.grpId=G.grpId)
WHERE G.grpId=1 AND E.evaId=2;

-- Datos generales del alumno
SELECT * FROM detGrupo dg
INNER JOIN Alumno a ON dg.almId = a.almId
INNER JOIN Grupo g ON dg.grpId = g.grpId
INNER JOIN Grado gra ON g.grdId = gra.grdId;

-- Listdo de materias a las que pertenece el alumno
SELECT g.grpId,m.matCodigo,m.matNombre FROM detGrupo dg
INNER JOIN Grupo g ON dg.grpId = g.grpId
INNER JOIN Materia m ON g.matId = m.matId
INNER JOIN Alumno a ON dg.almId = a.almId
WHERE dg.almId = 1;

-- Listado de notas por alumno y evaluacion
SELECT G.grpId, D.dgrpId, E.evaId, e.evaNombre, N.notPorcentaje, N.notTot,
	CASE WHEN n.notId IS NULL THEN 0 ELSE n.notId END AS notId,
	CASE WHEN n.notNota IS NULL THEN 0 ELSE n.notNota END AS nota
FROM Grupo G
	JOIN detGrupo D on (G.grdId=D.grpId)
	JOIN Alumno A on (D.almId=A.almId)
	JOIN Evaluacion E on (G.grpId=E.grpId)
    LEFT JOIN Nota N on (N.evaId=E.evaId and N.almId=A.almId and N.grpId=G.grpId)
WHERE N.almId = 1 AND N.grpId=1;

select * from nota;
select * from evaluacion;
insert into detGrupo(grpId,almId) values(2,1),(2,4);
-- ------------------------------------------ Procedimientos almacenados ------------------------------------------ --

DROP PROCEDURE IF EXISTS spAddEmpleado;

DELIMITER $$
CREATE PROCEDURE spAddEmpleado (IN p_empNombre VARCHAR(50),IN p_empApellidoP VARCHAR(50), IN p_empApellidoM VARCHAR(50),
	IN p_empSexo CHAR(1),IN p_empDUI VARCHAR(10),IN p_empNIT VARCHAR(20),IN p_empISSS VARCHAR(20),IN p_empNUP VARCHAR(20),
	IN p_empDireccion VARCHAR(400),IN p_empEmail VARCHAR(100),IN p_tempId INT, IN p_empTelCasa VARCHAR(15),IN p_empCelular VARCHAR(15),
	IN p_empFechaNac DATE,IN p_empProfesion VARCHAR(250))
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i, empId INT;
    
    SET codigo = CONCAT(SUBSTRING(p_empApellidoP,1,1), SUBSTRING(p_empApellidoM,1,1), SUBSTRING(YEAR(NOW()),3,2));
	SELECT CAST(SUBSTRING(MAX(empCodigo),5,4) AS SIGNED) INTO i FROM Empleado WHERE SUBSTRING(empCodigo,3,2) = SUBSTRING(YEAR(NOW()),3,2);
    
    IF (i >= 1) THEN 
		SET i = i + 1;
     ELSE
		SET i = 1;
	END IF;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    INSERT INTO Empleado(empCodigo,empNombre,empApellidoP,empApellidoM,empSexo,empDUI,empNIT,empISSS,empNUP,empDireccion,empEmail,tempId,empTelCasa,
			empCelular,empFechaNac,empProfesion) 
		VALUES(codigo,p_empNombre,p_empApellidoP,p_empApellidoM,p_empSexo,p_empDUI,p_empNIT,p_empISSS,p_empNUP,p_empDireccion,p_empEmail,p_tempId,p_empTelCasa,
			p_empCelular,p_empFechaNac,p_empProfesion);
	
    SET empId = LAST_INSERT_ID();
        
	-- Agregandolo a la plataforma para que pueda adminstrar a los grados asignados
    
    INSERT INTO Usuario(usrUsuario,usrNombre,usrPassword,rolId,empId) VALUES(codigo,CONCAT(p_empNombre,' ',p_empApellidoP,' ',p_empApellidoM),SHA2(codigo,256),(SELECT rolId FROM Rol WHERE rolNombre = 'Docente'),empId);
    
    -- Retornando el código generado
    
	SELECT codigo;
END $$
DELIMITER ;

#Alumno
DROP PROCEDURE IF EXISTS spAddAlumno;

DELIMITER $$
CREATE PROCEDURE spAddAlumno (IN p_almNie VARCHAR(8), IN p_almNombre VARCHAR(50),IN p_almApellidoP VARCHAR(50), IN p_almApellidoM VARCHAR(50),IN p_almFechaNac DATE,
IN p_almLugarNac VARCHAR(100),IN p_almSexo CHAR(1),IN p_almDireccion VARCHAR(400),IN p_almMadre VARCHAR(100),IN p_almPadre VARCHAR(100),
IN p_almTelCasa VARCHAR(15),IN p_almTelCel VARCHAR(15),IN p_almCorreo VARCHAR(50),IN p_almResponsable VARCHAR(50),IN p_almTelResponsable VARCHAR(15),
IN p_grdId INTEGER, IN p_almMadreDui VARCHAR(10), IN p_almPadreDui VARCHAR(10), IN p_dptId INT, IN p_munId INT)
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i INTEGER;
    DECLARE almId INTEGER;
    DECLARE b BIT DEFAULT 0;
    DECLARE curGrupo CURSOR FOR SELECT grpId FROM Grupo WHERE grdId = p_grdId;
    
    -- Condición de salida
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET b = 1;
  
    -- Creación de código para el alumno
    SET codigo = YEAR(NOW());
	SELECT CAST(SUBSTRING(MAX(almCodigo),5,4) AS UNSIGNED) INTO i FROM Alumno WHERE SUBSTRING(almCodigo,1,4) = YEAR(NOW());
    
    IF (i >= 1) THEN 
		SET i = i + 1;
     ELSE
		SET i = 1;
	END IF;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    
    -- Insertando los datos personales
    INSERT INTO Alumno(almCodigo,almNie,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,
			almTelResponsable,almMadreDui,almPadreDui,dptId,munId)
		VALUES(codigo,p_almNie,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,
			p_almResponsable,p_almTelResponsable,p_almMadreDui,p_almPadreDui,p_dptId,p_munId);
	
    SET almId = LAST_INSERT_ID();
    
    -- Enrolandolo en todas las materias que posee el nivel
    
    OPEN curGrupo;
    getGrupos: LOOP
		FETCH curGrupo INTO i;
		IF b = 1 THEN
			LEAVE getGrupos;
		ELSE
			INSERT INTO detGrupo(grpId,almId) VALUES(i, almId);
		END IF;
		
	END LOOP getGrupos;
    CLOSE curGrupo;
    
    -- Agregandolo a la plataforma para que pueda ver sus notas    
    INSERT INTO Usuario(usrUsuario,usrNombre,usrPassword,rolId,almId) VALUES(codigo,CONCAT(p_almNombre,' ',p_almApellidoP,' ',p_almApellidoM),SHA2(codigo,256),(SELECT rolId FROM Rol WHERE rolNombre = 'Alumno'),almId);
        
    -- Retornando el código generado
    
    SELECT codigo;
END $$
DELIMITER ;

-- Matricula antiguo ingreso
DROP PROCEDURE IF EXISTS spAddAlumno;

DELIMITER $$
CREATE PROCEDURE spAddAlumnoAntiguo (IN p_almCodigo VARCHAR(8))
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i INTEGER;
    DECLARE almId INTEGER;
    DECLARE b BIT DEFAULT 0;
    DECLARE curGrupo CURSOR FOR SELECT grpId FROM Grupo WHERE grdId = p_grdId;
    
    -- Condición de salida
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET b = 1;
  
    
    -- Insertando los datos personales
    INSERT INTO Alumno(almCodigo,almNie,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,
			almTelResponsable,almMadreDui,almPadreDui,dptId,munId)
		VALUES(codigo,p_almNie,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,
			p_almResponsable,p_almTelResponsable,p_almMadreDui,p_almPadreDui,p_dptId,p_munId);
	
    SET almId = LAST_INSERT_ID();
    
    -- Retornando el código generado
    
    SELECT codigo;
END $$
DELIMITER ;



-- ------------------------------------------ Triggers ------------------------------------------ --
DROP TRIGGER IF EXISTS trNotaAfterInsert;

DELIMITER $$
CREATE TRIGGER trNotaBeforeInsert
BEFORE INSERT ON Nota
FOR EACH ROW
BEGIN
	SET NEW.notPorcentaje = (SELECT evaPorcentaje FROM Evaluacion WHERE evaId = NEW.evaId);
END $$
DELIMITER ;

DROP TRIGGER IF EXISTS trNotaAfterUpdate;

DELIMITER $$
CREATE TRIGGER trNotaAfterUpdate
BEFORE UPDATE ON Nota
FOR EACH ROW
BEGIN
	SET NEW.notPorcentaje = (SELECT evaPorcentaje FROM Evaluacion WHERE evaId = NEW.evaId);
END $$
DELIMITER ;