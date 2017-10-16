-- Add table "sec_apps"

CREATE TABLE sec_apps (
    app_name VARCHAR(128) NOT NULL,
    app_type VARCHAR(300),
    description VARCHAR(255),
    PRIMARY KEY (app_name)
);

-- Add table "sec_groups"

CREATE TABLE sec_groups (
    group_id INTEGER NOT NULL generated always as identity (start with 0, increment by 1, no cache),
    description VARCHAR(64),
    PRIMARY KEY (group_id),
  	UNIQUE (description)
);

-- Add table "sec_groups_apps"

CREATE TABLE sec_groups_apps (
    group_id INTEGER NOT NULL,
    app_name VARCHAR(128) NOT NULL,
    priv_access VARCHAR(1),
    priv_insert VARCHAR(1),
    priv_delete VARCHAR(1),
    priv_update VARCHAR(1),
    priv_export VARCHAR(1),
    priv_print VARCHAR(1),
    PRIMARY KEY (group_id, app_name)
);

-- Add table "sec_users"

CREATE TABLE sec_users (
    login VARCHAR(32) NOT NULL,
    pswd VARCHAR(32) NOT NULL,
    name VARCHAR(64),
    email VARCHAR(64),
    active VARCHAR(1),
    activation_code VARCHAR(32),
    priv_admin VARCHAR(1),
    PRIMARY KEY (login)
);

-- Add table "sec_users_apps"

CREATE TABLE sec_users_apps (
    login VARCHAR(32) NOT NULL,
    app_name VARCHAR(128) NOT NULL,
    priv_access VARCHAR(1),
    priv_insert VARCHAR(1),
    priv_delete VARCHAR(1),
    priv_update VARCHAR(1),
    priv_export VARCHAR(1),
    priv_print VARCHAR(1),
    PRIMARY KEY (login, app_name)
);

-- Add table "sec_users_groups"

CREATE TABLE sec_users_groups (
    login VARCHAR(32) NOT NULL,
    group_id INTEGER NOT NULL,
    PRIMARY KEY (login, group_id)
);

-- Add table "sec_logged"

CREATE TABLE sec_logged (
    login VARCHAR(32)  NOT NULL,
    date_login VARCHAR(128),
    sc_session VARCHAR(32),
    FOREIGN KEY(login)
        REFERENCES sec_users(login) ON DELETE CASCADE,
    PRIMARY KEY (login)
);
