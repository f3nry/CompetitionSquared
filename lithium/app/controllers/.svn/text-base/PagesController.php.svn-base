<?php

namespace app\controllers;

class PagesController extends \lithium\action\Controller {

	public function view() {
		$path = func_get_args();

		if (empty($path)) {
			$path = array('home');
		}

                $this->set(array("isPage" => true, 'jquery' => true, 'page' => implode('/', $path)));

		$this->render(array('template' => join('/', $path)));
	}

        public function contact() {
            if($this->request->data) {
                $to = "paulhenry@mphwebsystems.com";
                $from = "From: " . $this->request->data["name"] .  " <" . $this->request->data["email"] . ">" . "\r\n";
                $subject = "[Competition Squared] " . $this->request->data["subject"];
                $body = $this->request->data["message"];

                if(!mail($to, $subject, $body, $from)) {
                    $this->set(array("error" => true, "message" => "Your message was not sent successfully."));
                } else {
                    $this->set(array("error" => false, "message" => "Your message was sent successfully."));
                }
            }

            $this->set(array("isPage" => true, 'page' => 'contact'));
        }
}

?>