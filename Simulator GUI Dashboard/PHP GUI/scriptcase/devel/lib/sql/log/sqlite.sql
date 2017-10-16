CREATE TABLE "tabela_log" (
	id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	inserted_date datetime,
	username varchar(90) NOT NULL,
	application varchar(200) NOT NULL,
	creator varchar(30) NOT NULL,
	ip_user varchar(32) NOT NULL,
	action varchar(30) NOT NULL,
	description TEXT
)
