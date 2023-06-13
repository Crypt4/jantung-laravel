<?php

namespace Crypt4\JantungLaravel\Metric;

use Crypt4\Jantung\Metric\Base;

class Framework extends Base
{
    public function metrics(): array
    {
        return [
            'framework.name' => 'Laravel',
            'framework.version' => app()->version(),
        ];
    }
}
