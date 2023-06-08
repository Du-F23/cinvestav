@extends('layouts.email')
@section('title', 'Proposal Assigned')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Proposal: {{ $projectName }}</h1>
            <p>Dear {{ $userName }}, we have assigned the proposal {{ $projectName }} to your account.</p>
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

