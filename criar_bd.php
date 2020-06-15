<?php

include('includes/connection.php');

$sql = <<<SQL
	CREATE TABLE IF NOT EXISTS audios ( 
		id 			INTEGER PRIMARY KEY, 
		autor 		TEXT, 
		idade 		INTEGER, 
		sexo 		TEXT, 
		emocao 		INTEGER,
		descricao 	TEXT, 
		filename 	TEXT,
		ip 			TEXT
	)
SQL;

$db->exec($sql);

header("Location: banco.php");