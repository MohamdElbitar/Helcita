<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentReminder extends Notification
{
    use Queueable;

    public $appointment;

    // تمرير الموعد للمريض
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // إرسال الإشعار عبر البريد الإلكتروني أو قاعدة البيانات
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your next appointment is scheduled.')
                    ->action('View Appointment', url('/appointments/'.$this->appointment->id))
                    ->line('Please be on time!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your next appointment is scheduled.',
            'appointment_id' => $this->appointment->id,
            'appointment_time' => $this->appointment->appointment_time,
            'url' => route('Clinic.appointments.show', $this->appointment->id), // Generate the route URL

        ];
    }
}
