<?php

return array(
	'style' => array(
		'error' => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice' => 'alert alert-warning',
	),
	'controllersDir' => __DIR__ . '/../controllers/',
	'modelsDir' => __DIR__ . '/../models/',
	'viewsDir' => __DIR__ . '/../views/',
	'domain' => 'http://bwlc.myleft.org/',
	'baseUri' => '/',
	'crypt' => '$%^$#$%',
	'db' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '123456',
		'dbname' => 'bwlc',
	)
);
