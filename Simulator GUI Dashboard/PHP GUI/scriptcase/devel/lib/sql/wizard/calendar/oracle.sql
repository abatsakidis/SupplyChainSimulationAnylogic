CREATE TABLE calendar (
      id		int NOT NULL ,
      title 		varchar(300) NOT NULL,
      description 	CLOB,
      start_date	date NOT NULL,
      start_time	date,
      end_date		date,
      end_time		date,
      recurrence	varchar(1),
      period		varchar(1),
      PRIMARY KEY (id)
    )
