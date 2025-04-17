#!/bin/sh -e
# shellcheck disable=SC2086
VERSION=$1
OPTION=$2
CONFIG_FILE="php.ini"

# op オプションが指定されている場合は op.php.ini を使用
if [ "$OPTION" = "op" ]; then
    CONFIG_FILE="op.php.ini"
fi


if phpbrew system | grep -qx "$VERSION"; then
	/usr/local/php/$VERSION/bin/php -c $CONFIG_FILE -n exe.php
else
	echo "Usage: $0 <version>"
	phpbrew system
	exit 1
fi