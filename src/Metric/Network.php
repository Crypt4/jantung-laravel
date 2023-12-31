<?php

namespace Crypt4\JantungLaravel\Metric;

use Crypt4\Jantung\Metric\Base;

class Network extends Base
{
    public function metrics(): array
    {
        return [
            'net.host.name' => request()->getHost(),
            'net.host.port' => request()->getPort(),
            'net.protocol.name' => app()->runningInConsole() ? 'CLI' : 'HTTP',
            'net.protocol.version' => ! app()->runningInConsole() ? request()->getProtocolVersion() : '',
        ];
    }
}
