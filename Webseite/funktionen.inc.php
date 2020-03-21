<?php

/* *************************** */
/* *** Datenbankverbindung *** */
/* *************************** */
function db_connect()
{
	// Zugangsdaten für die DB
	$dbhost = 'localhost';			//'localhost'
	$dbuser = 'Benutzername';  		//'pi',
	$dbpass = 'Passwort';			//'raspberry',
	$dbname = 'DB-Name';			//'DB-Name'
	
	// Verbindung herstellen und Verbindungskennung zurück geben
	$conid = mysql_connect( $dbhost, $dbuser, $dbpass ) or die( 'Verbindungsfehler!' );
	if (is_resource( $conid ))
	{
		mysql_select_db( $dbname, $conid ) or die( 'Datenbankfehler!' );
	}
	return $conid;
}

?>