<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class textMessage extends Notification
{
  use Queueable;

  protected $following;
  protected $followed;
  protected $textContent;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
   public function __construct($following,$followed,$textContent)
   {

       $this->following = $following;  //关注者 or 粉丝
       $this->followed = $followed;
       $this->textContent = $textContent;
   }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
        return ['database'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
      return (new MailMessage)
                  ->line('The introduction to the notification.')
                  ->action('Notification Action', url('/'))
                  ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
        'message' => 'userId ( '.$this->following->id.')'.$this->following->name.' sent [ '.$this->textContent.' ]'.'blogger ( '.$this->followed->id.' ) '.$this->followed->name,
        'link' => '/profiles/'.$this->following->name
    ];
  }
}
