<?php

namespace Iplan\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Iplan\Entity\Project;
use Iplan\Entity\User;
Use Iplan\Entity\WorkItem;

class NotifyAssignWorkItemToMember extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * Project instance.
     */
    protected $project;

    /**
     * User instance.
     *
     * @var $user
     */
    protected $user;

    /**
     * Work item instance.
     *
     * @var $workItem
     */
    protected $workItem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user, WorkItem $workItem)
    {
        $this->project = $project;
        $this->user = $user;
        $this->workItem = $workItem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notification@iPlan.mu')
                    ->subject('You have been assigned a work item on the project"'.$this->project->name.'" on iPlan')
                    ->view('emails.notifications.assigned-work-item-email')
                    ->with([
                        'project'  => $this->project,
                        'user'     => $this->user,
                        'workItem' => $this->workItem,
                        'title'    => 'You have been assigned a work item on the project"'.$this->project->name.'" on iPlan',
                        'link'     => route('work-items.show', ['project_id' => $this->project->id, 'work-item_id' => $this->workItem->id])
                    ]);
    }
}
