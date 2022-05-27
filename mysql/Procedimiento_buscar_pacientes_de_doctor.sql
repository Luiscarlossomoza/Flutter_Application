DROP PROCEDURE IF EXISTS Buscar_pacientes_doctor;

CREATE PROCEDURE Buscar_pacientes_doctor(_cod_doctor INT)
SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
WHERE P.cod_paciente = PT.cod_paciente
AND  PT.cod_tratamiento = T.cod_tratamiento
AND T.cod_tratamiento = DT.cod_tratamiento
AND DT.cod_doctor = D.cod_doctor
AND D.cod_doctor = _cod_doctor;
CALL Buscar_pacientes_doctor(1);