<?php

namespace Iplan\Notifications;

use Iplan\Entity\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddedAsMemberToProject extends Notification
{
    use Queueable;

    /**
     * The Project the user has been added to.
     *
     * @var Project
     */
    protected $project;

    /**
     * AddedAsMemberToProject constructor.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notification_text' => $this->project->owner->full_name.' added you as a member to the project "'.$this->project->name.'"',
            'link'              => route('projects.show', ['project_id' => $this->project->id]),
            'icon_class'        => 'fa fa-file',
        ];
    }
}
