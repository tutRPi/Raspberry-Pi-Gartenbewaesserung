<?php
 
/* ******************************* */
/* *** Datenbankverbindung PDO *** */
/* ******************************* */

// Neue Verbindung herstellen.
// Ersetzen Sie Hostnamen, DB-Name, Benutzernamen, Passwort entsprechend Ihrer Datenbank
$link = new \PDO(   'mysql:host=localhost;dbname=DB-Name;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
					'Benutzernamen', //'pi',
					'Passwort', //'raspberry',
					array(
						\PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						\PDO::ATTR_PERSISTENT => false
					)
				);

?>