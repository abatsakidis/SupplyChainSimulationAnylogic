/* Add table "sec_apps"                                                   */

CREATE TABLE "sec_apps" (
    "app_name" TEXT NOT NULL,
    "app_type" TEXT,
    "description" TEXT,
    PRIMARY KEY ("app_name")
);

/* Add table "sec_groups"                                                 */

CREATE TABLE "sec_groups" (
    "group_id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "description" TEXT,
    UNIQUE ("description")
);

/* Add table "sec_groups_apps"                                            */

CREATE TABLE "sec_groups_apps" (
    "group_id" INTEGER NOT NULL,
    "app_name" TEXT NOT NULL,
    "priv_access" TEXT,
    "priv_insert" TEXT,
    "priv_delete" TEXT,
    "priv_update" TEXT,
    "priv_export" TEXT,
    "priv_print" TEXT,
    PRIMARY KEY ("group_id", "app_name")
);

/* Add table "sec_users"                                                  */

CREATE TABLE "sec_users" (
    "login" TEXT NOT NULL,
    "pswd" TEXT NOT NULL,
    "name" TEXT,
    "email" TEXT,
    "active" TEXT,
    "activation_code" TEXT,
    "priv_admin" TEXT,
    PRIMARY KEY ("login")
);

/* Add table "sec_users_apps"                                             */

CREATE TABLE "sec_users_apps" (
    "login" TEXT NOT NULL,
    "app_name" TEXT NOT NULL,
    "priv_access" TEXT,
    "priv_insert" TEXT,
    "priv_delete" TEXT,
    "priv_update" TEXT,
    "priv_export" TEXT,
    "priv_print" TEXT,
    PRIMARY KEY ("login", "app_name")
);

/* Add table "sec_users_groups"                                           */

CREATE TABLE "sec_users_groups" (
    "login" TEXT NOT NULL,
    "group_id" INTEGER NOT NULL,
    PRIMARY KEY ("login", "group_id")
);

/* Add table "sec_logged"                                           */

CREATE TABLE "sec_logged" (
    login TEXT NOT NULL,
    date_login TEXT,
    sc_session TEXT,
    FOREIGN KEY(login)
        REFERENCES sec_users(login) ON DELETE CASCADE,
    PRIMARY KEY (login)
);
