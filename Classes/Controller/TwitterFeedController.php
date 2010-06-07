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

/**
 * Controller for the TwitterFeed object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

// TODO: As your extension matures, you should use Tx_Extbase_MVC_Controller_ActionController as base class, instead of the ScaffoldingController used below.
class Tx_TwitterFeed_Controller_TwitterFeedController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_TwitterFeed_Domain_Repository_TwitterFeedRepository
	 */
	protected $twitterFeedRepository;
	
	/**
	 * @var Tx_TwitterFeed_Domain_Repository_TwitterAccountRepository
	 */
	protected $twitterAccountRepository;
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->twitterFeedRepository = t3lib_div::makeInstance ( 'Tx_TwitterFeed_Domain_Repository_TwitterFeedRepository' );
		$this->twitterAccountRepository = t3lib_div::makeInstance ('Tx_TwitterFeed_Domain_Repository_TwitterAccountRepository');
		
	}
	/**
	 * List action for this controller. Displays all TwitterFeeds.
	 */
	public function indexAction() {
		$twitterFeeds = $this->twitterFeedRepository->findAll ();
		var_dump ( $twitterFeeds );
		$this->view->assign ( 'twitterFeeds', $twitterFeeds );
	}
	
	/**
	 * Action that displays a single TwitterFeed
	 */
	public function showAction() {
		//die(print_r($this->twitterFeedRepository->findByAccountName('remco'),true));
		$ffdata = $this->request->getContentObjectData ();
		$options = t3lib_div::xml2array ( $ffdata ['pi_flexform'] );
		$displayFeed = $options ['data'] ['sDEF'] ['lDEF'] ['displayFeed'] ['vDEF'];
		$twitterFeed = $this->twitterFeedRepository->findByUid ( $displayFeed );
		
		$account = $twitterFeed->getAccount();
		if($account->getUserToken()==null || $account->getUserSecret==null) {
			die('You need to add a twitter authorization token/secret to the database manually for now.');
			
		}
		/*
		$feed = curl_init("http://twitter.com/statuses/user_timeline/19768085.json?count=20");
		curl_setopt($feed,CURLOPT_RETURNTRANSFER,true);
		$data = curl_exec($feed);
		$data = json_decode($data,true);
		//var_dump($data);
		curl_close($feed);
		*/
		$req_url = 'http://api.twitter.com/oauth/request_token';
		$authurl = 'https://api.twitter.com/oauth/authorize';
		$acc_url = 'https://api.twitter.com/oauth/access_token';
		$api_url = 'https://api.twitter.com';

		$args = $this->request->getArguments();
		if(isset($args['feed'])) {
			switch($args['feed']) {
				case 1:
					$fid=1;
					$title = "My";
					$getfeed = $api_url."/1/statuses/user_timeline.json";
					break;
				case 2:
					$fid=2;
					$title = "My Friends";
					$getfeed = $api_url."/1/statuses/home_timeline.json";
					break;
				case 3:
					$fid=3;
					$title = "Other Peoples";
					$getfeed = $api_url."/1/statuses/public_timeline.json";
					break;
				case 4:
					$fid=4;
					$title = "Search for 'remco'";
					$getfeed = "http://search.twitter.com/search.json?q=remco";
					break;
			}
		} else {
			$title = "My";
			$getfeed = $api_url."/1/statuses/user_timeline.json";
			$fid=1;
		}
		
		$json = apc_fetch("tx_twitterFeed_{$twitterFeed->getFeedName()}_JSON{$fid}");
		if($json===FALSE) {
			try {
				$oauth = new OAuth ( $this->settings['consumerKey'], $this->settings['consumerSecret'], OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION );
				$oauth->setToken ( $account->getUserToken(), $account->getUserSecret());
				$oauth->fetch ( $getfeed,null, OAUTH_HTTP_METHOD_GET );
				$json = json_decode ( $oauth->getLastResponse (),true);
				apc_store("tx_twitterFeed_{$twitterFeed->getFeedName()}_JSON{$fid}",$json,60*5);
				$status =  "fetched from Twitter using OAUTH/GET/JSON and put in the APC cache afterwards";
			} catch ( OAuthException $e ) {
					$this->flashMessages->add($e->getMessage());
					$status = "cat /proc/status > /dev/null";
			}
		} else {
			$status = "from APC cached JSON";		
		}
		//if($fid==4) print_r($json);
		$this->response->addAdditionalHeaderData("<script src=\"http://platform.twitter.com/anywhere.js?id={$this->settings['anywhereAPIKey']}&v=1\" type=\"text/javascript\"></script>");		
		$this->view->assign ( 'twitterFeed', $twitterFeed );
		$this->view->assign ( 'data', $json );
		$this->view->assign ( 'status',$status);
		$this->view->assign ( 'title',$title);
	}
	
	/**
	 * Displays a form for creating a new TwitterFeed
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterFeed $newTwitterFeed A fresh TwitterFeed object taken as a basis for the rendering
	 * @dontvalidate $newTwitterFeed
	 */
	public function newAction(Tx_TwitterFeed_Domain_Model_TwitterFeed $newTwitterFeed = NULL) {
		$this->view->assign ( 'newTwitterFeed', $newTwitterFeed );
	}
	
	/**
	 * Creates a new TwitterFeed and forwards to the index action.
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterFeed $newTwitterFeed A fresh TwitterFeed object which has not yet been added to the repository
	 */
	public function createAction(Tx_TwitterFeed_Domain_Model_TwitterFeed $newTwitterFeed) {
		$this->twitterFeedRepository->add ( $newTwitterFeed );
		$this->flashMessageContainer->add ( 'Your new TwitterFeed was created.' );
		$this->redirect ( 'index' );
	}
	
	/**
	 * Displays a form to edit an existing TwitterFeed
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed The TwitterFeed to display
	 * @dontvalidate $twitterFeed
	 */
	public function editAction(Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed) {
		$this->view->assign ( 'twitterFeed', $twitterFeed );
	}
	
	/**
	 * Updates an existing TwitterFeed and forwards to the index action afterwards.
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed The TwitterFeed to display
	 */
	public function updateAction(Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed) {
		$this->twitterFeedRepository->update ( $twitterFeed );
		$this->flashMessageContainer->add ( 'Your TwitterFeed was updated.' );
		$this->redirect ( 'index' );
	}
	
	/**
	 * Deletes an existing TwitterFeed
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed The TwitterFeed to be deleted
	 */
	public function deleteAction(Tx_TwitterFeed_Domain_Model_TwitterFeed $twitterFeed) {
		$this->twitterFeedRepository->remove ( $twitterFeed );
		$this->flashMessageContainer->add ( 'Your TwitterFeed was removed.' );
		$this->redirect ( 'index' );
	}
	
	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {
	}

}
?>