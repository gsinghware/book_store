<?php 

$connect_error = 'Sorry, we\'re experiencing connection problem';

mysql_connect('localhost', 'root', '') or die($connect_error);
mysql_select_db('phplogin') or die($connect_error);

?>