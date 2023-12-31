<?php

namespace Crypt4\JantungLaravel\Handler;

use Crypt4\Jantung\Data\Type;
use Crypt4\JantungLaravel\Actions\ExtractTags;
use Crypt4\JantungLaravel\Actions\FormatModel;
use Crypt4\JantungLaravel\Data\Entry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Events\NotificationFailed;

class HandleNotificationFailedEvent extends Base
{
    /**
     * Record a new notification message was sent.
     *
     * @return void
     */
    public function handle(NotificationFailed $event)
    {
        $notification_class = get_class($event->notification);
        $notifiable = $this->formatNotifiable($event->notifiable);
        $is_queued = in_array(ShouldQueue::class, class_implements($event->notification));

        $this->store(Entry::make(Type::NOTIFICATION, [
            'notification' => $notification_class,
            'queued' => $is_queued,
            'notifiable' => $notifiable,
            'channel' => $event->channel,
            'data' => $event->data,
        ])
            ->setHashFamily($this->hash($notification_class.$notifiable.date('Y-m-d')))
            ->tags($this->tags($event))
            ->toArray());
    }

    /**
     * Extract the tags for the given event.
     *
     * @param  \Illuminate\Notifications\Events\NotificationSent  $event
     * @return array
     */
    private function tags($event)
    {
        return array_merge([
            $this->formatNotifiable($event->notifiable),
        ], ExtractTags::from($event->notification));
    }

    /**
     * Format the given notifiable into a tag.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    private function formatNotifiable($notifiable)
    {
        if ($notifiable instanceof Model) {
            return FormatModel::given($notifiable);
        } elseif ($notifiable instanceof AnonymousNotifiable) {
            return 'Anonymous:'.implode(',', $notifiable->routes);
        }

        return get_class($notifiable);
    }
}
