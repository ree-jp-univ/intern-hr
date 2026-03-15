<?php
/**
 * The production database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
			'username'   => getenv('DB_USER'),
			'password'   => getenv('DB_PASSWORD'),
		),
	),
);
