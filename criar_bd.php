<?php

$db = new PDO("sqlite:audios.sqlite3");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = <<<SQL
	CREATE TABLE IF NOT EXISTS audios ( 
		id 			INTEGER PRIMARY KEY, 
		autor 		TEXT, 
		idade 		INTEGER, 
		sexo 			TEXT, 
		emocao 		TEXT,
		descricao 	TEXT, 
		filename 	TEXT,
		ip 			TEXT
	)
SQL;

$db->exec($sql);

header("Location: banco.php");