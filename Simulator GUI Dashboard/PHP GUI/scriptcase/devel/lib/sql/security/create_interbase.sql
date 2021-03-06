/* Add table "SEC_APPS"                                                   */

CREATE TABLE SEC_APPS (
    APP_NAME VARCHAR(128) NOT NULL,
    APP_TYPE VARCHAR(255),
    DESCRIPTION VARCHAR(255),
    PRIMARY KEY (APP_NAME)
);

/* Add table "SEC_GROUPS"                                                 */

CREATE TABLE SEC_GROUPS (
    GROUP_ID INTEGER NOT NULL,
    DESCRIPTION VARCHAR(64),
    PRIMARY KEY (GROUP_ID),
   	UNIQUE (DESCRIPTION)
);

/* Add table "SEC_GROUPS_APPS"                                            */

CREATE TABLE SEC_GROUPS_APPS (
    GROUP_ID INTEGER NOT NULL,
    APP_NAME VARCHAR(128) NOT NULL,
    PRIV_ACCESS VARCHAR(1),
    PRIV_INSERT VARCHAR(1),
    PRIV_DELETE VARCHAR(1),
    PRIV_UPDATE VARCHAR(1),
    PRIV_EXPORT VARCHAR(1),
    PRIV_PRINT VARCHAR(1),
    PRIMARY KEY (GROUP_ID, APP_NAME)
);

/* Add table "SEC_USERS"                                                  */

CREATE TABLE SEC_USERS (
    LOGIN VARCHAR(32) NOT NULL,
    PSWD VARCHAR(32) NOT NULL,
    NAME VARCHAR(64),
    EMAIL VARCHAR(64),
    "ACTIVE" VARCHAR(1),
    ACTIVATION_CODE VARCHAR(32),
    PRIV_ADMIN VARCHAR(1),
    PRIMARY KEY (LOGIN)
);

/* Add table "SEC_USERS_APPS"                                             */

CREATE TABLE SEC_USERS_APPS (
    LOGIN VARCHAR(32) NOT NULL,
    APP_NAME VARCHAR(128) NOT NULL,
    PRIV_ACCESS VARCHAR(1),
    PRIV_INSERT VARCHAR(1),
    PRIV_DELETE VARCHAR(1),
    PRIV_UPDATE VARCHAR(1),
    PRIV_EXPORT VARCHAR(1),
    PRIV_PRINT VARCHAR(1),
    PRIMARY KEY (LOGIN, APP_NAME)
);

/* Add table "SEC_USERS_GROUPS"                                           */

CREATE TABLE SEC_USERS_GROUPS (
    LOGIN VARCHAR(32) NOT NULL,
    GROUP_ID INTEGER NOT NULL,
    PRIMARY KEY (LOGIN, GROUP_ID)
);

/* Add table "SEC_LOGGED"                                           */

CREATE TABLE SEC_LOGGED (

    LOGIN VARCHAR(32)  NOT NULL,
    DATE_LOGIN VARCHAR(128),
    SC_SESSION VARCHAR(32),
    FOREIGN KEY(LOGIN)
        REFERENCES SEC_USERS(LOGIN) ON DELETE CASCADE,
    PRIMARY KEY (LOGIN)

);
