CREATE TABLE tabela_log (
    id SERIAL PRIMARY KEY,
    inserted_date Datetime YEAR TO FRACTION,
    username varchar(90) NOT NULL,
    application varchar(200) NOT NULL,
    creator varchar(30) NOT NULL,
    ip_user varchar(32) NOT NULL,
    action varchar(30) NOT NULL,
    description varchar(255)
)
