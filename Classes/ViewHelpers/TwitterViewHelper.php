<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2010 Remco Overdijk <remco@maxserv.nl>, MaxServ B.V.
 * 
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class Tx_TwitterFeed_ViewHelpers_TwitterViewHelper extends Tx_Fluid_Core_ViewHelper_TagBasedViewHelper {
	
	/**
	 * @var string
	 */
	protected $tagName = 'div';
	
	
	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments ();
		
		$this->registerUniversalTagAttributes ();
	}
	
	/**
	 * Render a Tweet
	 * @param array $tweet
	 */
	public function render($tweet) {
		$this->tag->addAttribute('id', "tweet-".$tweet['id']);
		$this->tag->addAttribute('class','tweet_content');
		$content = $tweet['text'];
		//Replace links
		$content = preg_replace('%[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]%','<a href="${0}" target="_blank">${0}</a>',$content);
		//Replace @usernames at the start of the content (indicating reply)
		//$content = preg_replace('/^@[a-zA-Z0-9]+/e',"'To <a href=\"http://www.twitter.com/'.substr('\\0',1).'\" class=\"tweet_username\" target=\"_blank\">\\0</a>: '",$content);
		//Replace @usernames with links to their profiles
		//$content = preg_replace('/ @[a-zA-Z0-9]+/e',"'<a href=\"http://www.twitter.com/'.substr('\\0',2).'\" class=\"tweet_username\" target=\"_blank\">\\0</a>'",$content);
		
		//Replace #hashtags with links to their searchpages
		$content = preg_Replace('/(^| )#[a-zA-Z0-9]+/e',"'<a href=\"http://www.twitter.com/#search?q=%23'.trim(str_replace('#','','\\0')).'\" class=\"tweet_hashtag\" target=\"_blank\">\\0</a>'",$content );
		$this->tag->setContent($content);		
		return $this->tag->render();
	}
}

?>