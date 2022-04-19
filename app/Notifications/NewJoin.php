<?php

namespace App\Notifications;

use App\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewJoin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @param Group $group
     * @return array
     */

    public function toDatabase($notifiable)
    {

        return [
            'msg' => "you have new join request in your group " .$this->group->group_name. " from ".$this->group->user_name,
            'in' => $this->group->in,
            'in_id' => $this->group->in_id,
//            'post_id' => $this->group->post_id,
        ];

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
