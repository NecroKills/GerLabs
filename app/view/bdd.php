<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=gerlabs', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
