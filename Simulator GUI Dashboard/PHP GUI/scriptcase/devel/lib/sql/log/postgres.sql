CREATE TABLE tabela_log (
	id serial PRIMARY KEY,
	inserted_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	username character varying(90) NOT NULL,
	application character varying(200) NOT NULL,
	creator character varying(30) NOT NULL,
	ip_user character varying(32) NOT NULL,
	action character varying(30) NOT NULL,
	description TEXT
)
