DROP PROCEDURE IF EXISTS Insertar_pregunta_formulario;
DELIMITER //
CREATE PROCEDURE Insertar_pregunta_formulario(_cod_formulario INT, _enunciado TEXT, _respuesta TEXT, _tipo_respuesta VARCHAR(200))
BEGIN
	DECLARE var_num_pregunta INTEGER;
	DECLARE var_cod_formulario INTEGER;
	DECLARE var_final INTEGER DEFAULT 0;
	DECLARE cursor1 CURSOR FOR SELECT cod_formulario,MAX(num_pregunta) FROM PREGUNTA WHERE cod_formulario = _cod_formulario;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET var_final = 1;
	OPEN cursor1;
		IF NOT EXISTS ( SELECT cod_formulario  FROM PREGUNTA WHERE cod_formulario = _cod_formulario ) THEN
			INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES (_cod_formulario,1,_enunciado,_enunciado,_tipo_respuesta);
		END IF;
		FETCH cursor1 INTO var_cod_formulario,var_num_pregunta;
        INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES (_cod_formulario,var_num_pregunta+1,_enunciado,_enunciado,_tipo_respuesta);
	CLOSE cursor1;
END//
DELIMITER ;
CALL Insertar_pregunta_formulario(33,"hola","hola","hola");
SELECT cod_formulario  FROM PREGUNTA WHERE cod_formulario = 36;
