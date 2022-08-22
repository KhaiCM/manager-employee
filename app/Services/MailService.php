<?php

namespace App\Services;

use App\Jobs\SendMailJob;

class MailService
{
    /**
     * Send password reset mail use queue.
     *
     * String $email
     * String $token
     * @return void
     */
    public function sendPasswordResetMail($email, $token)
    {
        SendMailJob::dispatch($email, $token);
    }
}
