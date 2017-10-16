/* Add table "sec_apps"                                                   */

CREATE TABLE sec_apps (
    app_name varchar(128) NOT NULL,
    app_type varchar(255),
    description varchar(255),
    PRIMARY KEY (app_name)
)
GO

/* Add table "sec_groups"                                                 */

CREATE TABLE sec_groups (
    group_id integer identity(0,1) NOT NULL,
    description varchar(64),
    PRIMARY KEY (group_id),
    UNIQUE (description)
)
GO

/* Add table "sec_groups_apps"                                            */

CREATE TABLE sec_groups_apps (
    group_id integer NOT NULL,
    app_name varchar(128) NOT NULL,
    priv_access varchar(1),
    priv_insert varchar(1),
    priv_delete varchar(1),
    priv_update varchar(1),
    priv_export varchar(1),
    priv_print varchar(1),
    PRIMARY KEY (group_id, app_name)
)
GO

/* Add table "sec_users"                                                  */

CREATE TABLE sec_users (
    login varchar(32) NOT NULL,
    pswd varchar(32) NOT NULL,
    name varchar(64),
    email varchar(64),
    active varchar(1),
    activation_code varchar(32),
    priv_admin varchar(1),
    PRIMARY KEY (login)
)
GO

/* Add table "sec_users_apps"                                             */

CREATE TABLE sec_users_apps (
    login varchar(32) NOT NULL,
    app_name varchar(128) NOT NULL,
    priv_access varchar(1),
    priv_insert varchar(1),
    priv_delete varchar(1),
    priv_update varchar(1),
    priv_export varchar(1),
    priv_print varchar(1),
    PRIMARY KEY (login, app_name)
)
GO

/* Add table "sec_users_groups"                                           */

CREATE TABLE sec_users_groups (
    login varchar(32) NOT NULL,
    group_id integer NOT NULL,
    PRIMARY KEY (login, group_id)
)
GO

/* Add table "sec_logged"                                           */

CREATE TABLE sec_logged (
    login varchar(32) NOT NULL,
    date_login varchar(128),
    sc_session varchar(32),
    FOREIGN KEY(login)
        REFERENCES sec_users(login) ON DELETE CASCADE,
    PRIMARY KEY (login)
)
GO
