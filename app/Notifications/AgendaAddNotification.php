<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgendaAddNotification extends Notification
{
    use Queueable;
    protected $agenda;

    public function __construct($agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->view('mail.tambahAgenda');
                    // ->line('Agenda Baru Telah Ditambahkan')
                    // ->line('Asal    : ' . $this->agenda->asal_dokumen)
                    // ->line('Perihal : ' . $this->agenda->perihal)
                    // ->line('Silahkan Masuk ke Website Untuk Melihatnya');
                    // ->line('Thank you for using our application!');
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
            //
        ];
    }
}
