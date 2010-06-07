<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Remco Overdijk <remco@maxserv.nl>, MaxServ B.V.
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * The Twitter Feed
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_TwitterFeed_Domain_Model_TwitterFeed extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * feedName
	 * @var string
	 * @validate NotEmpty
	 */
	public $feedName;
	
	/**
	 * account
	 * @var Tx_TwitterFeed_Domain_Model_TwitterAccount
	 */
	protected $account;
	
	
	
	/**
	 * Setter for feedName
	 *
	 * @param string $feedName feedName
	 * @return void
	 */
	public function setFeedName($feedName) {
		$this->feedName = $feedName;
	}

	/**
	 * Getter for feedName
	 *
	 * @return string feedName
	 */
	public function getFeedName() {
		return $this->feedName;
	}
	
	/**
	 * Setter for account
	 *
	 * @param Tx_TwitterFeed_Domain_Model_TwitterAccount $account account
	 * @return void
	 */
	public function setAccount(Tx_TwitterFeed_Domain_Model_TwitterAccount $account) {
		$this->account = $account;
	}

	/**
	 * Getter for account
	 *
	 * @return Tx_TwitterFeed_Domain_Model_TwitterAccount account
	 */
	public function getAccount() {
		return $this->account;
	}
	
}
?>