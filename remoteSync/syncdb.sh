#sync db
source config.sh;

MYSQL=$(which mysql)
AWK=$(which awk)
GREP=$(which grep)

TABLES=$($MYSQL -u $USER -p$PASSWORD $TARGET_DATABASE -e 'show tables' | $AWK '{ print $1}' | $GREP -v '^Tables' )

for t in $TABLES
do
	echo "Deleting $t table from $TARGET_DATABASE database..."
	$MYSQL -u"$USER" -p"$PASSWORD" "$TARGET_DATABASE" -e "drop table $t"
done

mysql -u"$USER" -p"$PASSWORD" "$TARGET_DATABASE" < "$MYSQL_FILE"

#update wp-options and wp-posts page
query="update wp_options set option_value = REPLACE(option_value, '$OLD_DOMAIN','$NEW_DOMAIN')"
$MYSQL -u"$USER" -p"$PASSWORD" "$TARGET_DATABASE" -e "$query"

#update wp-posts
query="update wp_posts set guid = REPLACE(guid, '$OLD_DOMAIN','$NEW_DOMAIN')"
$MYSQL -u"$USER" -p"$PASSWORD" "$TARGET_DATABASE" -e "$query"





