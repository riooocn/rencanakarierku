<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Permintaan Reset Password')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena kami menerima permintaan untuk mengatur ulang kata sandi (reset password) pada akun Anda.')
            ->action('Reset Password', $url)
            ->line('Tautan reset password ini akan kedaluwarsa dalam ' . config('auth.passwords.'.config('auth.defaults.passwords').'.expire') . ' menit.')
            ->line('Jika Anda tidak meminta reset password, Anda tidak perlu melakukan tindakan apapun.')
            ->salutation('Salam hangat, Tim Rencana Karierku');
    }
}
