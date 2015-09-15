#include config file
source config.sh

#generate .mysql file
mysqldump -u"$LOCAL_USER" -p"$LOCAL_PASSWORD" "$DATABASE" > "$MYSQL_FILE"

#after generating mysql file should put everything to responsitory
cd ..
git add .
git commit -m "update"
git push -u origin HEAD








