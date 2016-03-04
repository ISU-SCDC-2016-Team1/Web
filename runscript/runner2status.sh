sshpass -p 'cdc' ssh cdc@runner2 "ps aux --sort -rss" | awk '{print $1","$2","$3","$4","$11$12$13}'
