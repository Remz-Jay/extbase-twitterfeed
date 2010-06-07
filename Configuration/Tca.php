<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_twitterfeed_domain_model_twitterfeed'] = array(
	'ctrl' => $TCA['tx_twitterfeed_domain_model_twitterfeed']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'feed_name,account'
	),
	'types' => array(
		'1' => array('showitem' => 'feed_name,account')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_twitterfeed_domain_model_twitterfeed',
				'foreign_table_where' => 'AND tx_twitterfeed_domain_model_twitterfeed.uid=###REC_FIELD_l18n_parent### AND tx_twitterfeed_domain_model_twitterfeed.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'feed_name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitterfeed.feed_name',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'account' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitterfeed.account',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_twitterfeed_domain_model_twitteraccount',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
	),
);

$TCA['tx_twitterfeed_domain_model_twitteraccount'] = array(
	'ctrl' => $TCA['tx_twitterfeed_domain_model_twitteraccount']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'user_name,pass_word'
	),
	'types' => array(
		'1' => array('showitem' => 'user_name,pass_word')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_twitterfeed_domain_model_twitteraccount',
				'foreign_table_where' => 'AND tx_twitterfeed_domain_model_twitteraccount.uid=###REC_FIELD_l18n_parent### AND tx_twitterfeed_domain_model_twitteraccount.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'user_name' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitteraccount.user_name',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'pass_word' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:twitter_feed/Resources/Private/Language/locallang_db.xml:tx_twitterfeed_domain_model_twitteraccount.pass_word',
			'config'  => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required,password'
			)
		),
		'user_token' => array(
			'exclude' => 0,			
			'config'  => array(
				'type' => 'passthrough')
		),
		'user_secret' => array(
			'exclude' => 0,			
			'config'  => array(
				'type' => 'passthrough')
		),
	),
);

?>