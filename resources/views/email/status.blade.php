@extends('layouts.email')
@section('title', 'Proposal Evaluated Status')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Proposal: {{ $projectName }}</h1>
            <p>Dear {{ $userName }}, your Proposal {{ $projectName }} has been @if($status == 1) Approved @else Rejected @endif.</p>
            <br>
            <p>Description of the Project: {{ $projectDescription }}</p>
            <br>
            <p>Rama: {{ $ramaName }}</p>
            <br>
            <p>For more information, please log in to the system and check the assigned proposal.</p>
            <br>
            <p>Best regards, CINVESTAV</p>
        </div>
    </div>
    <div class="dropdown-divider"></div>
@endsection
