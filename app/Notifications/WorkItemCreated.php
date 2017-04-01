<?php

namespace Iplan\Notifications;

use Iplan\Entity\User;
use Iplan\Entity\Project;
use Iplan\Entity\WorkItem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WorkItemCreated extends Notification
{
    use Queueable;

    /**
     * User Instance.
     *
     * @var User
     */
    protected $user;

    /**
     * Project Instance.
     *
     * @var Project
     */
    protected $project;

    /**
     * Work item instance.
     *
     * @var WorkItem
     */
    protected $workItem;

    /**
     * WorkItemCreated constructor.
     *
     * @param User     $user
     * @param Project  $project
     * @param WorkItem $workItem
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
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

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
            'notification_text' => $this->user->full_name. ' created a work item on your project "'.$this->project->name.'"',
            'link'              =>  route('work-items.show', ['project_id'=> $this->project->id, 'work-item_id' => $this->workItem->id]),
            'icon_class'        => 'fa fa-tasks'
        ];
    }
}
