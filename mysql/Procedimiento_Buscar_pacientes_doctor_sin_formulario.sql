DROP PROCEDURE IF EXISTS Buscar_pacientes_doctor_sin_formulario;

CREATE PROCEDURE Buscar_pacientes_doctor_sin_formulario(_cod_doctor INT, _cod_formulario INT)
SELECT *
FROM (SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
	  FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
	  WHERE P.cod_paciente = PT.cod_paciente
	  AND  PT.cod_tratamiento = T.cod_tratamiento
	  AND T.cod_tratamiento = DT.cod_tratamiento
	  AND DT.cod_doctor = D.cod_doctor
      AND D.cod_doctor = _cod_doctor) AS pacientes_doctor
WHERE pacientes_doctor.cp NOT IN (SELECT PF.cod_paciente
								  FROM paciente_formulario AS PF,FORMULARIO AS F
								  WHERE PF.cod_formulario = F.cod_formulario
								  AND F.cod_doctor = _cod_doctor
                                  AND F.cod_formulario = _cod_formulario);
CALL Buscar_pacientes_doctor_sin_formulario(1,101);