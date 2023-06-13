<?php

namespace Crypt4\JantungLaravel\Metric;

use Crypt4\Jantung\Metric\Base;

class Application extends Base
{
    public function metrics(): array
    {
        return [
            'app.controller.action' => optional(request()->route())->getActionName(),
            'app.middleware' => array_values(optional(request()->route())->gatherMiddleware() ?? []),
            'app.environment' => app()->environment(),
        ];
    }
}
