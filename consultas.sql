-- -------------------------------------Consultas---------------------------------------------------
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