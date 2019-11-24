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

-- Grado, turno y docente guía
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


CREATE TABLE IF NOT EXISTS Grupo( #Para DocenteMateria
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

INSERT INTO Departamento(dptCodigo,dptNombre) VALUES('Ahuachapán'),('Cabañas'),('Chalatenango'),('Cuscatlán'),('La Libertad'),('La Paz'),
('La Unión'),('Morazán'),('San Miguel'),('San Salvador'),('San Vicente'),('Santa Ana'),('Sonsonate'),('Usulután')

INSERT INTO Municipio(munCodigo,munNombre,munCodPostal) VALUES
('01-01','Ahuachapán'),('01-02','Apaneca'),('01-03','Atiquizaya'),('01-04','Concepción de Ataco'),('01-05','El Refugio'),('01-06','Guaymango'),
('01-07','Jujutla'),('01-08','San Francisco Menéndez'),('01-09','San Lorenzo'),('01-10','San Pedro Puxtla'),('01-11','Tacuba'),('01-12','Turín'),
('02-01','Cinquera'),('02-02','Dolores'),('02-03','Guacotecti'),('02-04','Ilobasco'),('02-05','Jutiapa'),('02-06','San Isidro'),
('02-07','Sensuntepeque'),('02-08','Tejutepeque'),('02-09','Victoria')




INSERT INTO Turno(turNombre,turActivo) VALUES('Matutino',1),('Vespertino',1),('Nocturno',1);

INSERT INTO Rol(rolNombre,rolRedirect) VALUES('Administrador','admin'),('Alumno','alumno'),('Docente','docente');
INSERT INTO Acceso(accVista) VALUES('Panel de administración'),('Panel docente'),('Panel alumno'),('Tipo empleados'),('Empleados'),('Materias'),('Niveles'),
	('Grados'),('Grupos'),('Alumnos'),('Matricula');
INSERT INTO RolAcceso(rolId,accId) VALUES(1,1),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(2,2),(3,3);
INSERT INTO Usuario VALUES(null,'admin','Administrador','5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5',1,null);


#-------------------------------------Consultas---------------------------------------------------
-- Login
SELECT u.rolId,u.usrNombre,u.empId,r.rolRedirect,u.almId FROM Usuario u
INNER JOIN Rol r ON u.rolId = r.rolId
WHERE u.usrUsuario = 'admin' AND u.usrPassword = '5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5';

-- Accesos
SELECT a.accVista FROM RolAcceso ra
INNER JOIN Rol r ON ra.rolId = r.rolId
INNER JOIN Acceso a ON ra.accId = a.accId
INNER JOIN Usuario u ON u.rolId = r.rolId
WHERE ra.rolId = 2;

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
	IN p_empDireccion VARCHAR(400),IN p_empEmail VARCHAR(100),IN p_tempId INT)
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
    INSERT INTO Empleado(empCodigo,empNombre,empApellidoP,empApellidoM,empSexo,empDUI,empNIT,empISSS,empNUP,empDireccion,empEmail,tempId) 
		VALUES(codigo,p_empNombre,p_empApellidoP,p_empApellidoM,p_empSexo,p_empDUI,p_empNIT,p_empISSS,p_empNUP,p_empDireccion,p_empEmail,p_tempId);
	
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
CREATE PROCEDURE spAddAlumno (IN p_almNombre VARCHAR(50),IN p_almApellidoP VARCHAR(50), IN p_almApellidoM VARCHAR(50),IN p_almFechaNac DATE,
IN p_almLugarNac VARCHAR(100),IN p_almSexo CHAR(1),IN p_almDireccion VARCHAR(400),IN p_almMadre VARCHAR(100),IN p_almPadre VARCHAR(100),
IN p_almTelCasa VARCHAR(15),IN p_almTelCel VARCHAR(15),IN p_almCorreo VARCHAR(50),IN p_almResponsable VARCHAR(50),IN p_almTelResponsable VARCHAR(15),
IN p_grdId INTEGER)
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
    INSERT INTO Alumno(almCodigo,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,almTelResponsable) 
		VALUES(codigo,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,p_almResponsable,p_almTelResponsable);
	
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

-- ------------------------------------------ Triggers ------------------------------------------ --
DROP TRIGGER IF EXISTS trNotaAfterInsert;

DELIMITER $$
CREATE TRIGGER trNotaAfterInsert
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