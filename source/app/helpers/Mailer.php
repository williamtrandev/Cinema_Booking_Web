<?php
// Import thư viện PHP Mailer
// $mail = new PHPMailer(true);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer
{
	private static $instance;
	private $mailer;

	private function __construct()
	{
		$this->mailer = new PHPMailer(true);
		// Cấu hình các thông tin của SMTP server
		$this->mailer->isSMTP();
		$this->mailer->Host = 'smtp.gmail.com';
		$this->mailer->SMTPAuth = true;
		$this->mailer->Username = 'trantanthanh2k3lop12@gmail.com';
		$this->mailer->Password = 'ztzmwknkkfnlrjrr';
		$this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$this->mailer->Port = 587;
		$this->mailer->setFrom('trantanthanh2k3lop12@gmail.com');
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new Mailer();
		}
		return self::$instance;
	}

	public function getMailer()
	{
		return $this->mailer;
	}
	public function sendMail($to, $subject, $body) {
		try {
			$this->mailer->addAddress($to);
			$this->mailer->isHTML(true);
			$this->mailer->Subject = $subject;
			$this->mailer->Body = $body;
			// Gửi email
			$this->mailer->send();
			return true;
		} catch (Exception $e) {
			// Xử lý ngoại lệ nếu có lỗi xảy ra khi gửi email
			error_log("Error sending email: " . $e->getMessage());
			return false;
		}
	}
}


?>