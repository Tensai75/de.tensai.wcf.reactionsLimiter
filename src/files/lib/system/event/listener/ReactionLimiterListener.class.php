<?php
namespace wcf\system\event\listener;

use wcf\system\WCF;
use wcf\system\exception\NamedUserException;

/**
 * @author 	Tensai
 * @package	de.tensai.wcf.reactionsLimiter
 */
class ReactionLimiterListener implements IParameterizedEventListener {

	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName, array &$parameters) {

		$day = 60 * 60 * 24;
		$week = $day * 7;
		$month = $day * 30;

		if ($className == 'wcf\data\reaction\ReactionAction' && $eventName == 'validateAction') {
			
			$maxLikesPerDay = intval(WCF::getSession()->getPermission('user.like.maxLikesPerDay'));
			if ($maxLikesPerDay > 0) {
				$sql = "SELECT COUNT(likeID) FROM wcf".WCF_N."_like WHERE userID=? && time > ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute([WCF::getUser()->userID, time()-$day]);
				$row = $statement->fetchArray();
				if ($row['COUNT(likeID)'] >= $maxLikesPerDay) {
					throw new NamedUserException(WCF::getLanguage()->getDynamicVariable('wcf.like.maxLikesPerDayReached'));
				}
			}
			
			$maxLikesPerWeek = intval(WCF::getSession()->getPermission('user.like.maxLikesPerWeek'));
			if ($maxLikesPerWeek > 0) {
				$sql = "SELECT COUNT(likeID) FROM wcf".WCF_N."_like WHERE userID=? && time > ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute([WCF::getUser()->userID, time()-$week]);
				$row = $statement->fetchArray();
				if ($row['COUNT(likeID)'] >= $maxLikesPerWeek) {
					throw new NamedUserException(WCF::getLanguage()->getDynamicVariable('wcf.like.maxLikesPerWeekReached'));
				}
			}
			
			$maxLikesPerMonth = intval(WCF::getSession()->getPermission('user.like.maxLikesPerMonth'));
			if ($maxLikesPerMonth > 0) {
				$sql = "SELECT COUNT(likeID) FROM wcf".WCF_N."_like WHERE userID=? && time > ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute([WCF::getUser()->userID, time()-$month]);
				$row = $statement->fetchArray();
				if ($row['COUNT(likeID)'] >= $maxLikesPerMonth) {
					throw new NamedUserException(WCF::getLanguage()->getDynamicVariable('wcf.like.maxLikesPerMonthReached'));
				}
			}
			
		}

	}
}