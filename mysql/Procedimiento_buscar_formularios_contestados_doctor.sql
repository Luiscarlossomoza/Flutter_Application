DROP PROCEDURE IF EXISTS buscar_formularios_contestados_doctor;

CREATE PROCEDURE buscar_formularios_contestados_doctor(_cod_doctor INT)
SELECT PF.cod_formulario,PF.cod_paciente,PF.fecha_contestado
FROM (SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
	  FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
	  WHERE P.cod_paciente = PT.cod_paciente
	  AND  PT.cod_tratamiento = T.cod_tratamiento
	  AND T.cod_tratamiento = DT.cod_tratamiento
	  AND DT.cod_doctor = D.cod_doctor
      AND D.cod_doctor = _cod_doctor) AS pacientes_doctor,
      FORMULARIO AS F,
      PACIENTE_FORMULARIO AS PF
WHERE pacientes_doctor.cp = PF.cod_paciente
AND PF.cod_formulario = F.cod_formulario
AND F.cod_doctor = _cod_doctor
AND PF.contestado = 1;

CALL buscar_formularios_contestados_doctor(1);