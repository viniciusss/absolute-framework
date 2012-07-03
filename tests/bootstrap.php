<?php

namespace Test;

require '../lib/SplClassLoader.php';

ini_set('memory_limit', '2048M');

$classLoader = new \SplClassLoader('Absolute', '../lib');
$classLoader->register();

$options = array(
		'database' => "mysql",
		'host'		=> "127.0.0.1",
		'dbname'	=> "test",
		'username'	=> "root",
		'password'	=> "",
		'extras'	=> array()
	);

function encode($n) {
	$codeset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$base = strlen($codeset);
	$converted = "";
	while ($n > 0) {
		$converted .= $codeset[$n%$base];
		$n = (int) ($n/$base);
 	}

	return $converted;
}

echo encode(99999999999999);

exit;

$adapter = new PDO($options);

$connection = Connection::getConnection("default", $adapter);

$connection->insert("testes", array("teste" => 123));
