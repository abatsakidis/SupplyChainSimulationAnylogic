CREATE TABLE [tabela_log]
    (
	id int primary key IDENTITY(1,1) NOT NULL,
	inserted_date datetime NOT NULL,
	username varchar(90) NOT NULL,
	application varchar(200) NOT NULL,
	creator varchar(30) NOT NULL,
	ip_user varchar(32) NOT NULL,
	[action] varchar(30) NOT NULL,
	description TEXT
)  ON [PRIMARY]
