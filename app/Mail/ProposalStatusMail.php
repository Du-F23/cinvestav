<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProposalStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;
    public $project;
    public $user;
    public $rama;
    public $status;

    public function __construct($proposal, $project, $user, $rama, $status)
    {
        $this->proposal = $proposal;
        $this->project = $project;
        $this->user = $user;
        $this->rama = $rama;
        $this->status = $status;
    }

    public function build(): ProposalStatusMail
    {
        return $this->view('email.status')
            ->subject('Proposal Status Report')
            ->with([
                'archive' => $this->proposal->archive,
                'projectName' => $this->project->name,
                'projectDescription' => $this->project->description,
                'ramaName' => $this->rama->name,
                'userName' => $this->user->name,
                'status' => $this->status,
            ]);
    }
}
