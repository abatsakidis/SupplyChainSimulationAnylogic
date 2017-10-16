CREATE TABLE calendar (
      id		 AUTOINCREMENT,
      title		varchar(255) NOT NULL,
      description	varchar(255),
      start_date	date NOT NULL,
      start_time	time,
      end_date	date,
      end_time	time,
      recurrence	varchar(1),
      period		varchar(1),
      PRIMARY KEY (id)
    )
