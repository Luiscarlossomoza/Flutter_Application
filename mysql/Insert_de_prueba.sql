INSERT INTO PACIENTE(cedula_paciente,nombre_paciente,correo_paciente,clave_paciente,tipo_diabetes) VALUES ("2","carlos","carlos@gmail.com","123","2");
INSERT INTO TRATAMIENTO (desc_tratamiento, cod_paciente,muestra,fecha_muestra,cod_doctor) VALUES ("prueba", 2,0,NULL,1);
INSERT INTO PACIENTE_TRATAMIENTO(cod_tratamiento,cod_paciente) VALUES (2,2);
INSERT INTO DOCTOR_TRATAMIENTO(cod_tratamiento,cod_doctor) VALUES (2,1);

INSERT INTO HOSPITAL (nombre_hospital, direc_hospital) VALUES ("Clinica de Prueba", "Direccion de prueba");
INSERT INTO ESPECIALIDAD ( nombre_especialidad, desc_especialidad) VALUES ("Especialidad de prueba", "Direccion de prueba");
INSERT INTO DOCTOR (cedula_doctor,nombre_doctor,correo_doctor, clave_doctor,consultorio_doctor,cod_especialidad,cod_hospital) VALUES ("11997576",'prueba','prueba','123','cpnsultorio prueba',1,1);
INSERT INTO TRATAMIENTO (desc_tratamiento, cod_paciente,muestra,fecha_muestra) VALUES ("prueba", 1,0,NULL);

INSERT INTO PACIENTE_TRATAMIENTO(cod_tratamiento,cod_paciente) VALUES (1,1);
INSERT INTO DOCTOR_TRATAMIENTO(cod_tratamiento,cod_doctor) VALUES (1,1);