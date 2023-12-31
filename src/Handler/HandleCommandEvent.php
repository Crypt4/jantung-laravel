<?php

namespace Crypt4\JantungLaravel\Handler;

use Crypt4\Jantung\Data\Type;
use Crypt4\JantungLaravel\Data\Entry;
use Illuminate\Console\Events\CommandFinished;
use Symfony\Component\Console\Command\Command;

class HandleCommandEvent extends Base
{
    public function handle(CommandFinished $event)
    {
        if ($this->shouldIgnore($event)) {
            return;
        }

        $command = $event->command ?? $event->input->getArguments()['command'] ?? 'default';
        $exitCode = $event->exitCode;

        $this->store(Entry::make(
            Type::COMMAND, [
                'command' => $command,
                'exit_code' => $exitCode,
                'arguments' => $event->input->getArguments(),
                'options' => $event->input->getOptions(),
            ]
        )->setHashFamily(
            $this->hash($command.$exitCode.date('Y-m-d'))
        )->toArray());
    }

    /**
     * Determine if the event should be ignored.
     *
     * @param  mixed  $event
     * @return bool
     */
    private function shouldIgnore($event)
    {
        return $event->exitCode !== Command::FAILURE;
    }
}
