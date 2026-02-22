<?php

namespace App\Helper;
use App\Models\EmailConfiguration;


    class MailHelper
    {
        public static function setMailConfig()
        {
            $emailConfig = EmailConfiguration::first();        

            // Set up the email configuration
            config([
                'mail.mailers.smtp.host' => $emailConfig->mail_host,
                'mail.mailers.smtp.port' => $emailConfig->mail_port,
                'mail.mailers.smtp.encryption' => $emailConfig->mail_encryption,
                'mail.mailers.smtp.username' => $emailConfig->mail_username,
                'mail.mailers.smtp.password' => $emailConfig->mail_password,
                'mail.from.address' => $emailConfig->mail_username,
            ]);

        }
    }



