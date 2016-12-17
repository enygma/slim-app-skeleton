#!/bin/sh
printf "\e[1;32m%-6s\e[m\n" "### Skeleton Setup"

printf "Moving .env.example to .env\n\n"
cp .env.example .env

default_appname="MyApp"

printf "Name of the application [MyApp]: "
read appname
if [[ "$appname" == "" ]]; then
    appname=$default_appname
fi
sed -i.bak "s/$default_appname/$appname/" .env
printf "\n"

printf "\e[1;32m%-6s\e[m" "Do you want to set up the database configuration? [Y/n] "

read dbsetup
if [[ "$dbsetup" == "" ]]; then
    dbsetup="Y"
fi

default_dbhost="localhost"
default_dbuser="myuser"
default_dbpass="mypass"
default_dbname="mydb"

if [ $dbsetup == 'Y' ] || [ $dbsetup == 'y' ]; then
    # Database host
    printf "Database host [$default_dbhost]: "
    read dbhost
    if [[ "$dbhost" == "" ]]; then
        dbhost=$default_dbhost
    fi
    sed -i.bak "s/$default_dbhost/$dbhost/" .env

    # Database username
    printf "Database user [$default_dbuser]: "
    read dbuser
    if [[ "$dbuser" == "" ]]; then
        dbhost=$default_dbuser
    fi
    sed -i.bak "s/$default_dbuser/$dbuser/" .env

    # Database password
    printf "Database password [$default_dbpass]: "
    read dbpass
    if [[ "$dbpass" == "" ]]; then
        dbhost=$default_dbpass
    fi
    sed -i.bak "s/$default_dbpass/$dbpass/" .env

    # Database name
    printf "Database name [$default_dbname]: "
    read dbname
    if [[ "$dbanme" == "" ]]; then
        dbhost=$default_dbname
    fi
    sed -i.bak "s/$default_dbname/$dbname/" .env

else
    printf "\e[1;31m%-6s\e[m\n\n" "Database configration left as default in .env"
fi

printf "\e[1;32m%-6s\e[m\n\n" "--- Setup complete!"
