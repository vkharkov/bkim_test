#!/bin/bash

echo "Creating user and database"
psql -v ON_ERROR_STOP=1 --username postgres --dbname app_db <<-EOSQL
    CREATE USER app_db WITH PASSWORD app_db;
    CREATE DATABASE app_db;
    GRANT ALL PRIVILEGES ON DATABASE app_db TO app_db;
EOSQL
}
