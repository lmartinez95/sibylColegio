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
tempCodigo VARCHAR(8),
tempNombre VARCHAR(50)
);

CREATE TABLE Empleado(
empId INTEGER AUTO_INCREMENT PRIMARY KEY,
empCodigo VARCHAR(8), CONSTRAINT UC_empCodigo UNIQUE (empCodigo),
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
tempId INTEGER, CONSTRAINT FK_TipoEmpleado_Empleado FOREIGN KEY(tempId) REFERENCES TipoEmpleado(tempId),
empPassword VARCHAR(64)
);

CREATE TABLE Nivel(
nvlId INTEGER AUTO_INCREMENT PRIMARY KEY,
nvlAbrev VARCHAR(10),
nvlNivel VARCHAR(25)
);

CREATE TABLE Materia(
matId INTEGER AUTO_INCREMENT PRIMARY KEY,
matCodigo VARCHAR(15),
matNombre VARCHAR(50)
);

CREATE TABLE Alumno(
almId INTEGER AUTO_INCREMENT PRIMARY KEY,
almCodigo VARCHAR(8), CONSTRAINT UC_almCodigo UNIQUE (almCodigo),
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
almFoto VARCHAR(100),
almPassword VARCHAR(64)
);
SELECT COUNT(empId) AS cant FROM Empleado WHERE empCodigo = 'RM180001' AND empPassword = SHA2('RM180001',256);
CREATE TABLE Grupo( #Para DocenteMateria
grpId INTEGER AUTO_INCREMENT PRIMARY KEY,
empId INTEGER, CONSTRAINT FK_Empleado_Grupo FOREIGN KEY(empId) REFERENCES Empleado(empId),
matId INTEGER, CONSTRAINT FK_Materia_Grupo FOREIGN KEY(matId) REFERENCES Materia(matId),
nvlId INTEGER, CONSTRAINT FK_Nivel_Grupo FOREIGN KEY(nvlId) REFERENCES Nivel(nvlID)
);

SELECT g.grpId,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) AS Empleado,m.matNombre,n.nvlNivel FROM Grupo g
INNER JOIN Empleado e ON g.empId = e.empId
INNER JOIN Materia m ON g.matId = m.matId
INNER JOIN Nivel n ON g.nvlId = n.nvlId;

CREATE TABLE detGrupo(
dgrpId INTEGER AUTO_INCREMENT PRIMARY KEY,
grpId INTEGER, CONSTRAINT FK_Grupo_DetalleGRupo FOREIGN KEY(grpId) REFERENCES Grupo(grpId),
almId INTEGER, CONSTRAINT FK_Alumno_DetalleGrupo FOREIGN KEY(almId) REFERENCES Alumno(almId)
);

CREATE TABLE Notas(
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
);

SELECT e.empCodigo,CONCAT(e.empNombre,' ',e.empApellidoP,' ',e.empApellidoM) as Nombre,
CASE e.empSexo WHEN 'M' THEN 'Masculino' ELSE 'Femenino' END AS Sexo,e.empDUI,te.tempNombre
FROM Empleado e INNER JOIN TipoEmpleado te ON e.tempId = te.tempId;


DROP PROCEDURE IF EXISTS spAddEmpleado;

DELIMITER $$
CREATE PROCEDURE spAddEmpleado (IN p_empNombre VARCHAR(50),IN p_empApellidoP VARCHAR(50), IN p_empApellidoM VARCHAR(50),
	IN p_empSexo CHAR(1),IN p_empDUI VARCHAR(10),IN p_empNIT VARCHAR(20),IN p_empISSS VARCHAR(20),IN p_empNUP VARCHAR(20),
	IN p_empDireccion VARCHAR(400),IN p_empEmail VARCHAR(100),IN p_tempId INT)
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i INT;
    
    SET codigo = CONCAT(SUBSTRING(p_empApellidoP,1,1), SUBSTRING(p_empApellidoM,1,1), SUBSTRING(YEAR(NOW()),3,2));
	SELECT CAST(SUBSTRING(MAX(empCodigo),5,4) AS UNSIGNED) INTO i FROM Empleado WHERE SUBSTRING(empCodigo,3,2) = SUBSTRING(YEAR(NOW()),3,2);
    
    CASE i
		WHEN i > 0 THEN SET i = i + 1;
        ELSE SET i = 1;
	END CASE;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    INSERT INTO Empleado(empCodigo,empNombre,empApellidoP,empApellidoM,empSexo,empDUI,empNIT,empISSS,empNUP,empDireccion,empEmail,tempId,empPassword) 
		VALUES(codigo,p_empNombre,p_empApellidoP,p_empApellidoM,p_empSexo,p_empDUI,p_empNIT,p_empISSS,p_empNUP,p_empDireccion,p_empEmail,p_tempId,SHA2(codigo,256));
	SELECT codigo;
END $$
DELIMITER ;


#Alumno
DROP PROCEDURE IF EXISTS spAddAlumno;

DELIMITER $$
CREATE PROCEDURE spAddAlumno (IN p_almNombre VARCHAR(50),IN p_almApellidoP VARCHAR(50), IN p_almApellidoM VARCHAR(50),IN p_almFechaNac DATE,
IN p_almLugarNac VARCHAR(100),IN p_almSexo CHAR(1),IN p_almDireccion VARCHAR(400),IN p_almMadre VARCHAR(100),IN p_almPadre VARCHAR(100),
IN p_almTelCasa VARCHAR(15),IN p_almTelCel VARCHAR(15),IN p_almCorreo VARCHAR(50),IN p_almResponsable VARCHAR(50),IN p_almTelResponsable VARCHAR(15))
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i INTEGER DEFAULT 0;
    
    SET codigo = YEAR(NOW());
	SELECT CAST(SUBSTRING(MAX(almCodigo),5,4) AS UNSIGNED) INTO i FROM Alumno WHERE SUBSTRING(almCodigo,1,4) = YEAR(NOW());
    
    CASE i
		WHEN i > 0 THEN SET i = i + 1;
        ELSE SET i = 1;
	END CASE;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    INSERT INTO Alumno(almCodigo,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,almTelResponsable,almPassword) 
		VALUES(codigo,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,p_almResponsable,p_almTelResponsable,SHA2(codigo,256));
	SELECT codigo;
END $$
DELIMITER ;

CALL spAddAlumno('Luis','Rivera','Martínez');

