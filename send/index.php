---
---
<?php

if($_SERVER['REQUEST_METHOD']!='POST') { exit('nothing to show'); }

$dir=getcwd().'/';
$filename='emails.csv';
$filepath=$dir.$filename;

$data['time']=date('c',time());
$data['meno']=$_POST['meno'] ?? null;
$data['email']=$_POST['email'] ?? null;
$data['sprava']=$_POST['sprava'] ?? null;
$data['ip']=$_SERVER['REMOTE_ADDR'];
$data['browser']=$_SERVER['HTTP_USER_AGENT'];

$file=fopen($filepath,'a+');

flock($file,LOCK_EX);
fputcsv($file,$data);
flock($file,LOCK_UN);
fclose($file);

mail(
	'zabatonni@gmail.com',
	'Napiste nam',
	json_encode($data),
	array(
		'From'=>'admin@gastrohouse.sk',
	)
);

header('Location: https://gastrohouse.sk/sent/');
exit;