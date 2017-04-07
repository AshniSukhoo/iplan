<?php

namespace Iplan\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Iplan\Entity\User;
use Iplan\Entity\Project;
use Iplan\Entity\WorkItem;

class NotifyUpdatedWorkItem extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *  User instance.
     *
     * @var $user
     */
    protected $user;

    /**
     * Project instance.
     *
     * @var $project
     */
    protected $project;

    /**
     * Workitem instance.
     *
     * @var $workItem
     */
    protected $workItem;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notification@iPlan.mu')
                    ->subject('A work item has been updated on the project "'.$this->project->name.'" on iPlan')
                    ->view('emails.notifications.updated-work-item-email')
                    ->with([
                        'user'     => $this->user,
                        'project'  => $this->project,
                        'workItem' => $this->workItem,
                        'title'    => 'A work item has been updated on the project"'.$this->project->name.'" on iPlan',
                        'link'     => route('work-items.show', ['project_id'=> $this->project->id, 'work-item_id' => $this->workItem->id])
                    ]);
    }



}
