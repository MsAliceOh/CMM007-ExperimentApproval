<?php
$name= $_GET['name'];

header('Content-Description: File Transfer');
header('Content-Type: application/force-download');
header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($name));
ob_clean();
flush();

readfile("C:/inetpub/wwwroot/1808957/CMM007-ExperimentApproval/docUpload/".$name); //showing the path to the server where the file is to be download

/*
readfile("C:/xampp/htdocs/CMM007-ExperimentApproval/docUpload".$name); //showing the path to the server where the file is to be download
*/

exit;
