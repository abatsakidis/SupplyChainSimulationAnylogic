CREATE TABLE "tabela_log" (
	id number PRIMARY KEY,
	inserted_date date,
	username VARCHAR2(90),
	application VARCHAR2(200),
	creator VARCHAR2(30),
	ip_user VARCHAR2(32),
	action VARCHAR2(30),
	description CLOB
)####NM####CREATE SEQUENCE sequence_log START WITH 1 increment BY 1####NM####CREATE TRIGGER tr_tabela_log BEFORE INSERT ON "tabela_log" for each row when (new.id is null) BEGIN SELECT sequence_log.nextval INTO :NEW.id FROM dual; END;
