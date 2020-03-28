<?php
#header("Location: estacionamento/?redir=ok");
#echo "Test";
print getenv("DB_HOST");
print getenv("DB_NAME");
print getenv("DB_USER");
print getenv("DB_PW");