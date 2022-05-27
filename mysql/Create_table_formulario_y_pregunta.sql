DROP TABLE IF EXISTS PREGUNTA;
DROP TABLE IF EXISTS FORMULARIO;
CREATE TABLE FORMULARIO (
	cod_formulario INT AUTO_INCREMENT NOT NULL,
    cod_doctor INT NOT NULL,
    cod_paciente INT DEFAULT NULL,
    contestado INT NOT NULL DEFAULT 0,
    fecha_contestado DATE DEFAULT NULL,
    ultima_muestra FLOAT DEFAULT 0,
    PRIMARY KEY(cod_formulario),
    FOREIGN KEY(cod_doctor) REFERENCES DOCTOR(cod_doctor),
	FOREIGN KEY(cod_paciente) REFERENCES PACIENTE(cod_paciente)
);
DROP TABLE IF EXISTS PREGUNTA;
CREATE TABLE PREGUNTA (
	cod_formulario INT NOT NULL,
    num_pregunta INT,
    enunciado TEXT NOT NULL,
    respuesta TEXT DEFAULT NULL,
    tipo_respuesta VARCHAR(200),
    PRIMARY KEY(cod_formulario,num_pregunta)
);