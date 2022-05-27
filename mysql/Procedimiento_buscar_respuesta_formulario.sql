DROP PROCEDURE IF EXISTS buscar_respuesta_formulario;

CREATE PROCEDURE buscar_respuesta_formulario(_cod_formulario INT)
SELECT num_pregunta,enunciado,respuesta
FROM PREGUNTA
WHERE cod_formulario = _cod_formulario;

CALL buscar_respuesta_formulario(224);