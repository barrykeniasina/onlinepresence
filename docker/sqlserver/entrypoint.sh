#!/bin/bash
#start SQL Server, start the script to create the DB and import the data, start the app
##/opt/mssql/bin/sqlservr & /tmp/setup/initial-sql.sh

set -e

if [ "$1" = '/opt/mssql/bin/sqlservr' ]; then
  if [ -f /tmp/app-initialized ]; then
  	rm -f /tmp/app-initialized
  fi

  # If this is the container's first run, initialize the application database
  if [ ! -f /tmp/app-initialized ]; then
    # Initialize the application database asynchronously in a background process. This allows a) the SQL Server process to be the main process in the container, which allows graceful shutdown and other goodies, and b) us to only start the SQL Server process once, as opposed to starting, stopping, then starting it again.
    function initialize_app_database() {
      # Wait a bit for SQL Server to start. SQL Server's process doesn't provide a clever way to check if it's up or not, and it needs to be up before we can import the application database
      sleep 15s

      #run the setup script to create the DB and the schema in the DB
      /opt/mssql-tools/bin/sqlcmd -S localhost -U sa -P $SA_PASSWORD -d master -i /tmp/setup/setup.sql

      # Note that the container has been initialized so future starts won't wipe changes to the data
      touch /tmp/app-initialized
    }
    initialize_app_database &
  fi
fi

# Run custom commands
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -Q "CREATE DATABASE ${DB_DATABASE}"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -Q "CREATE LOGIN ${DB_USERNAME} WITH PASSWORD = '${DB_PASSWORD}'"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -Q "ALTER SERVER ROLE sysadmin ADD MEMBER [${DB_USERNAME}]"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -d "${DB_DATABASE}" -Q "CREATE USER ${DB_USERNAME} for login ${DB_USERNAME}"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -d "${DB_DATABASE}" -Q "GRANT CONTROL ON DATABASE::${DB_DATABASE} TO ${DB_USERNAME} WITH GRANT OPTION"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -d "${DB_DATABASE}" -Q "CREATE SCHEMA ${DB_SCHEMA}"
# /opt/mssql-tools/bin/sqlcmd -S tcp:127.0.0.1,${DB_PORT} -U sa -P "${DB_PASSWORD}" -d "${DB_DATABASE}" -Q "ALTER USER [${DB_USERNAME}] WITH DEFAULT_SCHEMA = ${DB_SCHEMA}"

exec "$@"