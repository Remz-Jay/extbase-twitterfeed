<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Twitter Feed'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Twitter Feed');

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_twitterfeed_domain_model_twitterfeed','EXT:twitter_feed/Resources/Private/Language/locallang_csh_tx_twitterfeed_domain_model_twitterfeed.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_twitterfeed_domain_model_twitterfeed');
$TCA['tx_twitterfeed_domain_model_twitterfeed'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitterfeed',
		'label' 			=> 'feed_name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/Tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_twitterfeed_domain_model_twitterfeed.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_twitterfeed_domain_model_twitteraccount','EXT:twitter_feed/Resources/Private/Language/locallang_csh_tx_twitterfeed_domain_model_twitteraccount.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_twitterfeed_domain_model_twitteraccount');
$TCA['tx_twitterfeed_domain_model_twitteraccount'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitteraccount',
		'label' 			=> 'user_name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'hideTable'			=>  1,
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/Tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_twitterfeed_domain_model_twitteraccount.gif'
	)
);

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

?>