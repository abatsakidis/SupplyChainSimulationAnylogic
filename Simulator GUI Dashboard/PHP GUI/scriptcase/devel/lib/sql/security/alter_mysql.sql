# Alter table "sec_groups_apps"                                          #

ALTER TABLE `sec_groups_apps` ADD CONSTRAINT `sec_groups_apps_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `sec_groups` (`group_id`) ON DELETE CASCADE;
ALTER TABLE `sec_groups_apps` ADD CONSTRAINT `sec_groups_apps_ibfk_2` FOREIGN KEY (`app_name`) REFERENCES `sec_apps` (`app_name`) ON DELETE CASCADE;
# Alter table "sec_users_groups"                                         #

ALTER TABLE `sec_users_groups` ADD CONSTRAINT `sec_users_groups_ibfk_1` FOREIGN KEY (`login`) REFERENCES `sec_users` (`login`) ON DELETE CASCADE;
ALTER TABLE `sec_users_groups` ADD CONSTRAINT `sec_users_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `sec_groups` (`group_id`) ON DELETE CASCADE;
# Alter table "sec_users_apps"                                         #

ALTER TABLE `sec_users_apps` ADD CONSTRAINT `sec_users_apps_ibfk_1` FOREIGN KEY (`login`) REFERENCES `sec_users` (`login`) ON DELETE CASCADE;
ALTER TABLE `sec_users_apps` ADD CONSTRAINT `sec_users_apps_ibfk_2` FOREIGN KEY (`app_name`) REFERENCES `sec_apps` (`app_name`) ON DELETE CASCADE;
