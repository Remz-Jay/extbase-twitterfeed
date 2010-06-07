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
 * TwitterAccount
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_TwitterFeed_Domain_Model_TwitterAccount extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * userName
	 * @var string
	 * @validate NotEmpty
	 */
	protected $userName;
	
	/**
	 * passWord
	 * @var string
	 * @validate NotEmpty
	 */
	protected $passWord;
	
	
	/**
	 * userToken
	 * @var string
	 */
	protected $userToken;
	
	/**
	 * userSecret
	 * @var string
	 */
	protected $userSecret;
	
	
	/**
	 * Setter for userName
	 *
	 * @param string $userName userName
	 * @return void
	 */
	public function setUserName($userName) {
		$this->userName = $userName;
	}

	/**
	 * Getter for userName
	 *
	 * @return string userName
	 */
	public function getUserName() {
		return $this->userName;
	}
	
	/**
	 * Setter for passWord
	 *
	 * @param string $passWord passWord
	 * @return void
	 */
	public function setPassWord($passWord) {
		$this->passWord = $passWord;
	}

	/**
	 * Getter for passWord
	 *
	 * @return string passWord
	 */
	public function getPassWord() {
		return $this->passWord;
	}
	/**
	 * @return the $userToken
	 */
	public function getUserToken() {
		return $this->userToken;
	}

	/**
	 * @return the $userSecret
	 */
	public function getUserSecret() {
		return $this->userSecret;
	}

	/**
	 * @param $userToken the $userToken to set
	 */
	public function setUserToken($userToken) {
		$this->userToken = $userToken;
	}

	/**
	 * @param $userSecret the $userSecret to set
	 */
	public function setUserSecret($userSecret) {
		$this->userSecret = $userSecret;
	}

	
	
}
?>