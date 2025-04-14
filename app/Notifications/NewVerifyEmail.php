<?php

namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

class NewVerifyEmail extends VerifyEmail
{
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('小鉄のためのご近所鉄道スポットより、ご登録メールアドレスの確認です')
            ->line('ご登録ありがとうございます。')
            ->line('たくさんの鉄道スポットを共有していきましょう！')
            ->action('このボタンをクリック', $url)
            ->line('上記ボタンをクリックすると、ご登録が完了します！');
    }
}
