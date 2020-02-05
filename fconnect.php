<?php
//echo "'$COMPUTERNAME'";
//phpinfo();
$fcon=ftp_connect("127.0.0.1")or die("could not connect");
$res=ftp_login($fcon,"icollegeforum","")or die("login incorrect");
?>