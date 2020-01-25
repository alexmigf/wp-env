#!/bin/bash
source .env

if [[ -z "$ACF_PRO_KEY" ]]
then
    echo "You need to set ACF_PRO_KEY inside .env file."
    exit 1
fi

DIR=$PWD
DIR_WP="$DIR/public/"

echo "Checking for Composer"
COMPOSER_CMD=$(which composer)
if [[ "" == "$COMPOSER_CMD" ]]
then
    echo "Installing Composer"
    curl -sS https://getcomposer.org/installer | php -- --install-dir=bin
    COMPOSER_CMD=$(which composer)
else
    echo "Updating Composer"
    $COMPOSER_CMD selfupdate
fi
echo "Running Composer"

cd $DIR
if [[ "$WP_INSTALLED" == false ]]
then
    $COMPOSER_CMD update
    cp wp-config-bk.php wordpress/wp-config.php
    cp wp-dependencies-bk.json wordpress/composer.json
    cd .
    sed -i -e "/WP_.*INSTALLED/s/=.*/=true/g"  .env
    rm .env-e
    echo "Renaming the directory"
    mv wordpress public
    echo "WordPress Installed!"
fi

if [[ -d "$DIR_WP" ]]
then
    cd $DIR_WP
    export ACF_PRO_KEY=$ACF_PRO_KEY
    $COMPOSER_CMD update
    echo "WordPress Dependencies Updated!"
    echo "Done.."
fi
