<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Lang;

class UserVerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    public function toMail($notifiable)
    {
        $user = $notifiable;
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage)
            ->subject(Lang::get('Verificação de Email'))
            ->greeting("Olá {$user->first_name}")
            ->line(Lang::get('Por favor clique no botão abaixo para verificar seu email.'))
            ->action(Lang::get('Verificar Email'), $verificationUrl)
            ->line(Lang::get('Se você não criou essa conta, não é necessário fazer nenhuma ação.'))
            ->markdown('mails.default', ['currentSubdomain' => $user->current_subdomain]);
    }
}
