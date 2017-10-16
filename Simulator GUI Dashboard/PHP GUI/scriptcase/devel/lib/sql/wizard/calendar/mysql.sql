CREATE TABLE calendar (
      id		int(11) NOT NULL AUTO_INCREMENT,
      title		varchar(300) NOT NULL,
      description	text,
      start_date	date NOT NULL,
      start_time	time,
      end_date	date,
      end_time	time,
      recurrence	varchar(1),
      period		varchar(1),
      PRIMARY KEY (id)
    )
