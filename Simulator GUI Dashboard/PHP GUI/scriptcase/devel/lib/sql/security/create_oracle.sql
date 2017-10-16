/* Add table "sec_apps"                                                   */

CREATE TABLE sec_apps (
    app_name VARCHAR2(128) NOT NULL,
    app_type VARCHAR2(255),
    description VARCHAR2(255),
    PRIMARY KEY (app_name)
);

/* Add table "sec_groups"                                                 */

CREATE TABLE sec_groups (
    group_id NUMBER(10) NOT NULL,
    description VARCHAR2(64),
    PRIMARY KEY (group_id),
    UNIQUE (description)
);

/* Add table "sec_groups_apps"                                            */

CREATE TABLE sec_groups_apps (
    group_id NUMBER(10) NOT NULL,
    app_name VARCHAR2(128) NOT NULL,
    priv_access VARCHAR2(1),
    priv_insert VARCHAR2(1),
    priv_delete VARCHAR2(1),
    priv_update VARCHAR2(1),
    priv_export VARCHAR2(1),
    priv_print VARCHAR2(1),
    PRIMARY KEY (group_id, app_name)
);

/* Add table "sec_users"                                                  */

CREATE TABLE sec_users (
    login VARCHAR2(32) NOT NULL,
    pswd VARCHAR2(32) NOT NULL,
    name VARCHAR2(64),
    email VARCHAR2(64),
    active VARCHAR2(1),
    activation_code VARCHAR2(32),
    priv_admin VARCHAR2(1),
    PRIMARY KEY (login)
);

/* Add table "sec_users_apps"                                             */

CREATE TABLE sec_users_apps (
    login VARCHAR2(32) NOT NULL,
    app_name VARCHAR2(128) NOT NULL,
    priv_access VARCHAR2(1),
    priv_insert VARCHAR2(1),
    priv_delete VARCHAR2(1),
    priv_update VARCHAR2(1),
    priv_export VARCHAR2(1),
    priv_print VARCHAR2(1),
    PRIMARY KEY (login, app_name)
);

/* Add table "sec_users_groups"                                           */

CREATE TABLE sec_users_groups (
    login VARCHAR2(32) NOT NULL,
    group_id NUMBER(10) NOT NULL,
    PRIMARY KEY (login, group_id)
);

/* Add table "sec_logged"                                           */

CREATE TABLE sec_logged (
    login VARCHAR2(32)  NOT NULL,
    date_login VARCHAR2(128),
    sc_session VARCHAR2(32),
    FOREIGN KEY(login)
        REFERENCES sec_users(login) ON DELETE CASCADE,
    PRIMARY KEY (login)
)
