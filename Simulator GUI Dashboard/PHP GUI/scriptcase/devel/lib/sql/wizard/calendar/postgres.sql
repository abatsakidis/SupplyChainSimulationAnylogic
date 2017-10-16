CREATE TABLE calendar
    (
		id serial PRIMARY KEY,
		title character varying(300),
		description text,
		start_date date,
		start_time time without time zone,
		end_date date,
		end_time time without time zone,
		recurrence character(1),
		period character(1)
    )
