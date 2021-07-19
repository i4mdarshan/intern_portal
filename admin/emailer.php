<?php 

class emailer{

	private $sender;
	private $recipients;
	private $subject;
	private $body;


	function __construct($sender){

		$this->sender = $sender;
		$this->recipients = array();

	}

	public function addRecipient($recipient){

		array_push($this->recipients, $recipient);
	}

	public function setSubject($subject){

		$this->subject = $subject;

	}

	public function setBody($body){

		$this->body = $body;

	}

	public function sendEmail(){

		foreach ($this->recipients as $recipient) {
			
			$result = mail($recipient, $this->subject, $this->body, "From: portal.test.mailing@gamil.com");
			if ($result) {
				"Sent!";
			}
		}

	}

}

$emailerobject = new emailer ("portal.test.mailing@gamil.com");
$emailerobject->addRecipient("darshan.mahajan77777@gmail.com");
$emailerobject->setSubject("Test Mail");
$emailerobject->setBody("Hi! This is the first test mail.");
$emailerobject->sendEmail();

 ?>