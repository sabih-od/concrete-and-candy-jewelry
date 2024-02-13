<?php

namespace App\Traits;

trait PHPCustomMail
{
    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $html
     * @return bool
     */
    public function customMail($from, $to, $subject, $html, $attachment = null, $attachmentName = null)
    {
        $boundary = 'b1';

        $headers = [
            'MIME-Version: 1.0',
            'Content-type: multipart/mixed; boundary=' . $boundary,
            'From: ' . $from,
            'Reply-To: ' . $from,
            'X-Mailer: PHP/' . phpversion(),
        ];

        $message = $html . "\r\n\r\n";

        if ($attachment) {
            $attachmentData = chunk_split(base64_encode(file_get_contents($attachment->getPathname())));
            $message .= '<img src="data:image/jpeg;base64,' . $attachmentData . '" alt="Generated Image">' . "\r\n\r\n";

        }

        $fullHeaders = implode("\r\n", $headers);

        $fullHeaders .= "\r\n" . 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";

        return mail($to, $subject, $message, $fullHeaders);
    }


}
