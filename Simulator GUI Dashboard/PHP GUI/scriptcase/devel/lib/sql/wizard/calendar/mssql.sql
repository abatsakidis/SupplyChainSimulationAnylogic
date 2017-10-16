CREATE TABLE calendar
(
	id uniqueidentifier PRIMARY KEY NOT NULL,
	title varchar(300) NULL,
	description text NULL,
	start_date datetime NULL,
	start_time datetime,
	end_date datetime NULL,
	end_time datetime NULL,
	recurrence char(1) NULL,
	period char(1) NULL
)
