<?php

namespace Iplan\Notifications;

use Iplan\Entity\Project;
use Iplan\Entity\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Iplan\Entity\WorkItem;

class AssignWorkItemToMember extends Notification
{
    use Queueable;

    protected $user;

    protected $project;

    protected $workItem;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Project $project, WorkItem $workItem)
    {
        $this->user = $user;
        $this->project = $project;
        $this->workItem = $workItem;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            'notification_text' => $this->user->full_name. ' assigned you a work item on the project "'.$this->project->name.'"',
            'link'              => route('work-items.show', ['project_id'=> $this->project->id, 'work-item_id' => $this->workItem->id]),
            'icon_class'        => 'fa fa-tasks'
        ];
    }
}
