<?php

namespace Crypt4\JantungLaravel\Data;

use Crypt4\Jantung\Data\ExceptionEntry as DataExceptionEntry;
use Crypt4\JantungLaravel\Concerns\InteractsWithMetric;
use Illuminate\Contracts\Debug\ExceptionHandler;

class ExceptionEntry extends DataExceptionEntry
{
    use InteractsWithMetric;

    /**
     * Create a new incoming entry instance.
     *
     * @param  \Throwable  $exception
     * @param  string  $type
     * @return void
     */
    public function __construct($exception, $type, array $content)
    {
        parent::__construct($exception, $type, $content);

        $this->registerMetrics();
    }

    /**
     * Determine if the incoming entry is a reportable exception.
     *
     * @return bool
     */
    public function isReportableException()
    {
        $handler = app(ExceptionHandler::class);

        return method_exists($handler, 'shouldReport')
                ? $handler->shouldReport($this->exception) : true;
    }
}
