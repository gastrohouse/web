---
---
<?php

if($_SERVER['REQUEST_METHOD']!='POST') { exit('nothing to show'); }

$dir=getcwd().'/../../';
$filename='emails.csv';
$filepath=$dir.$filename;

$data['time']=date('c',time());
$data['sprava']=$_POST['sprava'] ?? null;

$file=fopen($filepath,'a+');

flock($file,LOCK_EX);
fputcsv($file,$data);
flock($file,LOCK_UN);
fclose($file);

header('Location: https://gastrohouse.sk/sent/');
exit;