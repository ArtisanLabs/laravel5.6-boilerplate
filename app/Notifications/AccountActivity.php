<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountActivity extends Notification {
	use Queueable;
	private $title;
	private $message;


	/**
	 * Create a new notification instance.
	 *
	 * @param string $title
	 * @param string $message
	 */
	public function __construct(string $title, string $message) {
		$this->title = $title;
		$this->message = $message;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		return (new MailMessage)
			->line('The introduction to the notification.')
			->action('Notification Action', url('/'))
			->line('Thank you for using our application!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			'title' => $this->title,
			'message' => $this->message
		];
	}
}
