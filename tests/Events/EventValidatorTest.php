<?php 

require_once "src/Events/EventValidator.php";
require_once "src/Events/Event.php";

use EventManager\Events\Event;
use EventManager\Events\EventValidator;

class EventValidatorTest extends PHPUnit_Framework_TestCase{
	
	public function testShouldReturnTrueWhenNameIsLessThen150Characters(){
		$validator = new EventValidator();
		$result = $validator->validate(new Event(
			"Nome",
			new \DateTime()
		));

		$this->assertTrue($result);
	}

	public function testShouldReturnFalseWhenNameIsGreaterThen150Characters(){
		$validator = new EventValidator();
		$result = $validator->validate(new Event(
			"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis pa",
			new \DateTime()
		));

		$this->assertFalse($result);
	}

	public function testShouldReturnTrueWhenEventDateEqualsToday(){
		$validator = new EventValidator();
		$result = $validator->validate(new Event(
			"Evento do Gabriel",
			new \DateTime()
		));

		$this->assertTrue($result);
	}

	public function testShouldReturnTrueWhenEventDateIsGreaterThenToday(){
		$validator = new EventValidator();
		$result = $validator->validate(new Event(
			"Evento do Gabriel",
			(new \DateTime())->add(new DateInterval('P1D'))
		));

		$this->assertTrue($result);
	}

	public function testShouldReturnFalseWhenEventDateIsLessThenToday(){
		$validator = new EventValidator();
		$result = $validator->validate(new Event(
			"Evento do Gabriel",
			(new \DateTime())->sub(new DateInterval('P1D'))
		));

		$this->assertFalse($result);
	}

}

?>