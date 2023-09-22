<?php

namespace App\Utils\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    public function send($data, $mailData): void
    {
        Mail::send('backend.mail.vakant', ['msg' => $mailData], function ($message) use ($data) {
            $message->to($data['subscriber']);
            $message->subject($data['subject']);
        });
    }

    public function acceptedMail($data): string
    {
        return '
        Hörmətli istifadəçi,

        "' . $data['title'] . '" başlıqlı elanınız qəbul edilmişdir və Vakant.Az saytında dərc olunmuşdur:
        https://vakant.az/job/' . $data['vacancy_id'] . '

        Elanınızla bağlı suallar üçün, eləcə də onun silinməsi, yaxud elana düzəlişlər edilməsi ilə əlaqədar ' . settings('email') . ' elektron ünvanına yazın, yaxud ' . settings('phone-1') . ' əlaqə telefonuna zəng edin.

        Hörmətlə,
        Vakant.az';
    }

    public function alreadyExists($data): string
    {
        return 'Hörmətli istifadəçi,

        Sizin "' . $data['title'] . '" başlıqlı elanınız qəbul edilməmişdir.

        Səbəb: Hal-hazırda sizin başqa saylı elanınız saytda var.

        Zəhmət olmasa, elanı yenidən qaydalara müvafiq şəkildə yerləşdirin.

        Elanınızın nömrəsi - ' . $data['vacancy_id'] . '.

        Elanla bağlı suallarınız üçün ' . settings('email') . ' elektron ünvanına yazın, yaxud ' . settings('phone-1') . ' əlaqə telefonuna zəng edin.

        Hörmətlə,
        Vakant.Az';
    }
}
