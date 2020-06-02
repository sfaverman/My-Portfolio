<?php
$file_url = '/Resume_Sofia_Faverman.pdf';
header('Content-Type: application/pdf');
header("Content-disposition: attachment; filename=\"" . 'Resume_Sofia_Faverman.pdf' . "\"");
readfile($file_url);
?>
