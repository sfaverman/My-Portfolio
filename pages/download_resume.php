<?php
$file_url = '/Resume_Sofia_Faverman.pdf';
header('Content-Type: application/pdf');
header("Content-disposition: attachment; filename=\"" . 'Sofia_Faverman_Resume.pdf' . "\"");
readfile($file_url);
?>
