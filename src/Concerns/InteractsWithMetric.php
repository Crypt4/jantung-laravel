<?php

namespace Crypt4\JantungLaravel\Concerns;

use Crypt4\JantungLaravel\Metric\Application;
use Crypt4\JantungLaravel\Metric\Framework;
use Crypt4\JantungLaravel\Metric\Http;
use Crypt4\JantungLaravel\Metric\Network;

trait InteractsWithMetric
{
    public function registerMetrics()
    {
        if (method_exists($this, 'addMetric')) {
            $this->addMetric(new Http);
            $this->addMetric(new Framework);
            $this->addMetric(new Application);
            $this->addMetric(new Network);
        }
    }
}
