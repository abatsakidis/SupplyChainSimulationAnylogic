CREATE TABLE [tabela_log] (
    id AUTOINCREMENT,
    inserted_date datetime,
    username varchar(90) NOT NULL,
    application varchar(200) NOT NULL,
    creator varchar(30) NOT NULL,
    ip_user varchar(32) NOT NULL,
    [action] varchar(30) NOT NULL,
    description varchar(255),
	PRIMARY KEY (id)
)
