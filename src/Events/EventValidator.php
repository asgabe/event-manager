<?php
namespace EventManager\Events;

use EventManager\Events\Event;

class EventValidator {

	private $result = true;

	public function validate(Event $event){
		if(strlen($event->getName()) <= 150) return true;
		if($event->getDate() >= new \DateTime()) return true;

		return false;
	}

	public function error(){
		$this->result = false;
	}

}
?>