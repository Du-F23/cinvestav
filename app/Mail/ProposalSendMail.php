<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;
    public $project;
    public $user;
    public $rama;

    public function __construct($proposal, $project, $user, $rama)
    {
        $this->proposal = $proposal;
        $this->project = $project;
        $this->user = $user;
        $this->rama = $rama;
    }

    public function build(): ProposalSendMail
    {
        return $this->view('email.assignedProposal')
            ->subject('Proposal Assigned')
            ->with([
                'archive' => $this->proposal->archive,
                'projectName' => $this->project->name,
                'projectDescription' => $this->project->description,
                'ramaName' => $this->rama->name,
                'userName' => $this->user->name,
            ]);
    }
}
