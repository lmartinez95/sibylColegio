CREATE DATABASE sibylColegio;
USE sibylColegio;

CREATE TABLE Colegio(
clgId INTEGER PRIMARY KEY,
clgNombre VARCHAR(75) NOT NULL,
clgDireccion VARCHAR(250),
clgTelefono VARCHAR(15),
clgFax VARCHAR(15),
clgEmail VARCHAR(75)
);

CREATE TABLE TipoEmpleado(
tempId INTEGER AUTO_INCREMENT PRIMARY KEY,
tempCodigo VARCHAR(8), CONSTRAINT UQ_tempCodigo UNIQUE (tempCodigo),
tempNombre VARCHAR(50)
);

CREATE TABLE Empleado(
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
empEmail VARCHAR(100),
tempId INTEGER, CONSTRAINT FK_TipoEmpleado_Empleado FOREIGN KEY(tempId) REFERENCES TipoEmpleado(tempId)
);

CREATE TABLE Nivel(
nvlId INTEGER AUTO_INCREMENT PRIMARY KEY,
nvlAbrev VARCHAR(10),
nvlNivel VARCHAR(25),
nvlIdPadre INTEGER, CONSTRAINT FK_Nivel_Nivel FOREIGN KEY(nvlIdPadre) REFERENCES Nivel(nvlId)
);

CREATE TABLE Turno(
turId INTEGER PRIMARY KEY,
turNombre VARCHAR(25),
turActivo BIT DEFAULT 0
);

CREATE TABLE Materia(
matId INTEGER AUTO_INCREMENT PRIMARY KEY,
matCodigo VARCHAR(15),
matNombre VARCHAR(50)
);

CREATE TABLE Grado(
grdId INTEGER PRIMARY KEY,
grdNombre VARCHAR(50),
turId INTEGER, CONSTRAINT FK_Turno_Grado FOREIGN KEY(turId) REFERENCES Turno(turId)
);

CREATE TABLE Alumno(
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
almMadre VARCHAR(100),
almPadre VARCHAR(100),
almTelCasa VARCHAR(15),
almTelCel VARCHAR(15),
almCorreo VARCHAR(50),
almResponsable VARCHAR(50),
almTelResponsable VARCHAR(15),
almFoto VARCHAR(100)
);

CREATE TABLE Grupo( #Para DocenteMateria
grpId INTEGER AUTO_INCREMENT PRIMARY KEY,
empId INTEGER, CONSTRAINT FK_Empleado_Grupo FOREIGN KEY(empId) REFERENCES Empleado(empId),
matId INTEGER, CONSTRAINT FK_Materia_Grupo FOREIGN KEY(matId) REFERENCES Materia(matId),
grdId INTEGER, CONSTRAINT FK_Grado_Grupo FOREIGN KEY(grdId) REFERENCES Grado(grdId)
);

CREATE TABLE detGrupo(
dgrpId INTEGER AUTO_INCREMENT PRIMARY KEY,
grpId INTEGER, CONSTRAINT FK_Grupo_DetalleGRupo FOREIGN KEY(grpId) REFERENCES Grupo(grpId),
almId INTEGER, CONSTRAINT FK_Alumno_DetalleGrupo FOREIGN KEY(almId) REFERENCES Alumno(almId)
);

CREATE TABLE Evaluacion(
evaId INTEGER AUTO_INCREMENT PRIMARY KEY,
evaNombre VARCHAR(50),
evaPorcentaje FLOAT, CONSTRAINT CHK_evaPorcentaje CHECK (notPorcentaje1 >= 0.0 AND notPorcentaje1 <= 1.0),
grpId INTEGER, CONSTRAINT FK_Grupo_Evaluaciones FOREIGN KEY(grpId) REFERENCES Grupo(grpId)
);

CREATE TABLE Nota(
notId INTEGER AUTO_INCREMENT PRIMARY KEY,
notNota FLOAT, CONSTRAINT CHK_notNota CHECK (notNota >= 0.0 AND notNota <= 10.0),
notPorcentaje FLOAT, CONSTRAINT CHK_notPorcentaje1 CHECK (notPorcentaje1 >= 0.0 AND notPorcentaje1 <= 1.0),
evaId INTEGER, CONSTRAINT FK_Evaluacion_Notas FOREIGN KEY(evaId) REFERENCES Evaluacion(evaId),
almId INTEGER, CONSTRAINT FK_Alumno_Notas FOREIGN KEY(almId) REFERENCES Alumno(almId),
grpId INTEGER, CONSTRAINT FK_Grupo_Notas FOREIGN KEY(grpId) REFERENCES Grupo(grpId)
);

CREATE TABLE HNotas(
hnotId INTEGER AUTO_INCREMENT PRIMARY KEY,
nvlNombre VARCHAR(25),
matNombre VARCHAR(50)

);

CREATE TABLE Rol(
rolId INTEGER AUTO_INCREMENT PRIMARY KEY,
rolNombre VARCHAR(50),
rolRedirect VARCHAR(15)
);

CREATE TABLE Acceso(
accId INTEGER AUTO_INCREMENT PRIMARY KEY,
accVista VARCHAR(25),
accDescripcion VARCHAR(50)
);

CREATE TABLE RolAcceso(
raccId INTEGER AUTO_INCREMENT PRIMARY KEY,
rolId INTEGER, CONSTRAINT FK_Rol_RolAcceso FOREIGN KEY(rolId) REFERENCES Rol(rolId),
accId INTEGER, CONSTRAINT FK_Acceso_RolAcceso FOREIGN KEY(accId) REFERENCES Acceso(accId)
);

CREATE TABLE Usuario(
usrId INTEGER AUTO_INCREMENT PRIMARY KEY,
usrUsuario VARCHAR(8), CONSTRAINT UQ_usrUsuario UNIQUE (usrUsuario),
usrNombre VARCHAR(50),
usrPassword VARCHAR(64),
rolId INTEGER, CONSTRAINT FK_Rol_Usuario FOREIGN KEY(rolId) REFERENCES Rol(rolId),
empId INTEGER
);

INSERT INTO Rol(rolNombre,rolRedirect) VALUES('Administrador','admin'),('Alumno','alumno'),('Docente','docente');
INSERT INTO Acceso(accVista) VALUES('Panel de administración');
INSERT INTO RolAcceso(rolId,accId) VALUES(1,1);
INSERT INTO Usuario VALUES(null,'admin','Administrador','5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5',1,null);


#-------------------------------------Consultas---------------------------------------------------
SELECT u.rolId,u.empId,r.rolRedirect FROM Usuario u
INNER JOIN Rol r ON u.rolId = r.rolId
WHERE u.usrUsuario = 'admin' AND u.usrPassword = '5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5';

SELECT a.accVista FROM RolAcceso ra
INNER JOIN Rol r ON ra.rolId = r.rolId
INNER JOIN Acceso a ON ra.accId = a.accId
INNER JOIN Usuario u ON u.rolId = r.rolId
WHERE ra.rolId = 1;

SELECT g.grpId,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) AS Empleado,m.matNombre,n.nvlNivel FROM Grupo g
INNER JOIN Empleado e ON g.empId = e.empId
INNER JOIN Materia m ON g.matId = m.matId
INNER JOIN Nivel n ON g.nvlId = n.nvlId
WHERE g.empId = 3;

/*CREATE TABLE Notas(
notId INTEGER AUTO_INCREMENT PRIMARY KEY,
notNota1 FLOAT, CONSTRAINT CHK_notNota1 CHECK (notNota1 >= 0.0 AND notNota1 <= 10.0),
notPorcentaje1 FLOAT, CONSTRAINT CHK_notPorcentaje1 CHECK (notPorcentaje1 >= 0.0 AND notPorcentaje1 <= 1.0),
notNota2 FLOAT, CONSTRAINT CHK_notNota2 CHECK (notNota2 >= 0.0 AND notNota2 <= 10.0),
notPorcentaje2 FLOAT, CONSTRAINT CHK_notPorcentaje2 CHECK (notPorcentaje2 >= 0.0 AND notPorcentaje2 <= 1.0),
notNota3 FLOAT, CONSTRAINT CHK_notNota3 CHECK (notNota3 >= 0.0 AND notNota3 <= 10.0),
notPorcentaje3 FLOAT, CONSTRAINT CHK_notPorcentaje3 CHECK (notPorcentaje3 >= 0.0 AND notPorcentaje3 <= 1.0),
notNota4 FLOAT, CONSTRAINT CHK_notNota4 CHECK (notNota4 >= 0.0 AND notNota4 <= 10.0),
notPorcentaje4 FLOAT, CONSTRAINT CHK_notPorcentaje4 CHECK (notPorcentaje4 >= 0.0 AND notPorcentaje4 <= 1.0),
notNota5 FLOAT, CONSTRAINT CHK_notNota5 CHECK (notNota5 >= 0.0 AND notNota5 <= 10.0),
notPorcentaje5 FLOAT, CONSTRAINT CHK_notPorcentaje5 CHECK (notPorcentaje5 >= 0.0 AND notPorcentaje5 <= 1.0),
notPromedio FLOAT AS ((notNota1*notPorcentaje1)+(notNota2*notPorcentaje2)+(notNota3*notPorcentaje3)+(notNota4*notPorcentaje4)+(notNota5*notPorcentaje5)),
almId INTEGER, CONSTRAINT FK_Alumno_Notas FOREIGN KEY(almId) REFERENCES Alumno(almId),
grpId INTEGER, CONSTRAINT FK_Grupo_Notas FOREIGN KEY(grpId) REFERENCES Grupo(grpId)
);*/

SELECT e.empCodigo,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) as Nombre,
CASE e.empSexo WHEN 'M' THEN 'Masculino' ELSE 'Femenino' END AS Sexo,e.empDUI,te.tempNombre
FROM Empleado e INNER JOIN TipoEmpleado te ON e.tempId = te.tempId;

SELECT a.almId,CONCAT(a.almNombre,' ',a.almApellidoP,' ',a.almApellidoM) as nombre FROM Alumno a
JOIN detGrupo dg ON dg.almId = a.almId
WHERE dg.grpId <> 1
HAVING COUNT(dg.almId) = 0;

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
    
    IF (i > 0) THEN 
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
    
    IF (i > 0) THEN 
		SET i = i + 1;
     ELSE
		SET i = 0;
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
    INSERT INTO Alumno(almCodigo,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,almTelResponsable,almPassword) 
		VALUES(codigo,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,p_almResponsable,p_almTelResponsable,SHA2(codigo,256));
	
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
    
    INSERT INTO Usuario VALUES(null, codigo,'5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5',(SELECT rolId FROM Rol WHERE rolNombre = 'Alumno'),null);
    
    -- Retornando el código generado
    
    SELECT codigo;
END $$
DELIMITER ;

CALL spAddAlumno('Fabiola Cecilia','Rivera','Martínez','2011-06-07','Soyapango','F','Urb. Abalam Pje. Cuscatlan Pol E #5E','Alicia Beatriz Rvera Martínez','','2299-1780','7968-4744','beamartinez@gmail.com','Marta Alcia Martínez','7954-9740',4);
select * from Alumno;
select * from detGrupo;
select * from Usuario;
delete from Alumno where almId = 5;
