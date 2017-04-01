<?php

namespace Iplan\Mail;

use Iplan\Entity\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Iplan\Entity\User;

class NotifyAddedAsMemberToProject extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Project Instance.
     *
     * @var Project
     */
    protected $project;

    /**
     * The Reciepient of the Email.
     *
     * @var User
     */
    protected $reciever;

    /**
     * NotifyAddedAsMemberToProject constructor.
     *
     * @param Project $project
     * @param User    $reciever
     */
    public function __construct(Project $project, User $reciever)
    {
        $this->project = $project;
        $this->reciever = $reciever;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifications@iplan.mu')
                    ->subject('You have been added as a member to the project "'.$this->project->name.'" on iPlan')
                    ->view('emails.notifications.added-to-project-email')
                    ->with([
                        'project'  => $this->project,
                        'reciever' => $this->reciever,
                        'title'    => 'You have been added as a member to the project "'.$this->project->name.'" on iPlan',
                        'link'     => route('projects.show', ['project_id' => $this->project->id]),
                    ]);
    }
}
