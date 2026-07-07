<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * From Email
     */
    public string $fromEmail = 'purnendu.india123@gmail.com';

    /**
     * From Name
     */
    public string $fromName = 'CI4_User_Login';

    /**
     * Recipients
     */
    public string $recipients = '';

    /**
     * User Agent
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * Mail Protocol
     */
    public string $protocol = 'smtp';

    /**
     * Mail Path
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Host
     */
    public string $SMTPHost = 'smtp.gmail.com';

    /**
     * SMTP Username
     */
    public string $SMTPUser = '';

    /**
     * SMTP App Password
     */
    public string $SMTPPass = '';

    /**
     * SMTP Port
     */
    public int $SMTPPort = 587;

    /**
     * SMTP Timeout
     */
    public int $SMTPTimeout = 60;

    /**
     * SMTP Keep Alive
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption
     */
    public string $SMTPCrypto = 'tls';

    /**
     * SMTP Auth Method
     */
    // public string $SMTPAuthMethod = 'login';

    /**
     * Mail Type
     */
    public string $mailType = 'html';

    /**
     * Charset
     */
    public string $charset = 'UTF-8';

    /**
     * Word Wrap
     */
    public bool $wordWrap = true;

    /**
     * Wrap Characters
     */
    public int $wrapChars = 76;

    /**
     * Validate Email
     */
    public bool $validate = false;

    /**
     * Priority
     */
    public int $priority = 3;

    /**
     * CRLF
     */
    public string $CRLF = "\r\n";

    /**
     * New Line
     */
    public string $newline = "\r\n";

    /**
     * BCC Batch Mode
     */
    public bool $BCCBatchMode = false;

    /**
     * BCC Batch Size
     */
    public int $BCCBatchSize = 200;

    /**
     * DSN
     */
    public bool $DSN = false;

    public bool $SMTPDebug = true;
}