    CREATE TABLE "tabela_log" (
	id INTEGER NOT NULL,
	inserted_date TIMESTAMP,
	username VARCHAR(90) CHARACTER SET NONE COLLATE NONE,
	application VARCHAR(200) CHARACTER SET NONE COLLATE NONE,
	creator varchar(30) NOT NULL,
	ip_user varchar(32) NOT NULL,
	action varchar(30) NOT NULL,
	description VARCHAR(900) CHARACTER SET NONE COLLATE NONE,
	CONSTRAINT "tabela_log_PK_id" PRIMARY KEY(id)
);

####NM####
CREATE GENERATOR "tabela_log_ID";
####NM####

SET GENERATOR "tabela_log_ID" TO 0;
####NM####
CREATE TRIGGER "BI_tabela_log_ID" FOR "tabela_log"
ACTIVE BEFORE INSERT
POSITION 0
AS
BEGIN
  IF (NEW.ID IS NULL) THEN
      NEW.ID = GEN_ID("tabela_log_ID", 1);
END