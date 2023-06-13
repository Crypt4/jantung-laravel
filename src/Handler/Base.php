<?php

namespace Crypt4\JantungLaravel\Handler;

use Crypt4\JantungLaravel\Transporter;

class Base
{
    private Transporter $transporter;

    public function __construct()
    {
        $this->transporter = app('jantung');
    }

    public function send(array $data)
    {
        $this->transporter->send($data);
    }

    public function hash($value)
    {
        return sha1($value);
    }
}
