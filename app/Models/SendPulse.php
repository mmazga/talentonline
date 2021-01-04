<?php


namespace App\Models;

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

class SendPulse
{
    /**
     * @param $html
     * @param $subject
     * @param $user_email
     * @throws \Exception
     */
    public function sendEmail($html, $subject, $user_email)
    {
        $SPApiClient = new ApiClient(env('SENDPULSE_USER_ID', '0'), env('SENDPULSE_SECRET', '0'), new FileStorage());
        $email = [
            'html' => $html,
            'subject' => $subject,
            'from' => [
                'name' => 'Talentonline',
                'email' => 'no-reply@email.com',
            ],
            'to' => [
                [
                    'email' => $user_email,
                ],
                [
                    'email' => 'archive@email.com',
                ],
            ],
        ];
        $SPApiClient->smtpSendMail($email);
    }
}
