<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'TwitterFeed' => 'show, index','TwitterAccount' => 'index, show',
	),
	array(
		'TwitterFeed' => 'show, index','TwitterAccount' => '',
	)
);
/**
 * Removed 1:
 * Twitterfeed: , new, create, edit, update, delete
 * TwitterAccount: , new, create, edit, update, delete
 * Removed 2: 
 * Twitterfeed: , create, update, delete
 * TwitterAccount: create, update, delete
 * 
 */
?>