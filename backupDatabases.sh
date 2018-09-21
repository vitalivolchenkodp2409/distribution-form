#!/bin/sh
# Used to backup databases so that we can keep a common username/passwords for example users
# Can be used to create sample users with different arrows and karmas easier
ssh -i "./sshKey" root@distribution.projectoblio.com "mysqldump -uroot -panyPassword msf > ~/databaseBackup1.sql";
scp -i "./sshKey" root@distribution.projectoblio.com:~/databaseBackup1.sql ./backupDatabases/
