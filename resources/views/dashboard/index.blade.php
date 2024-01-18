@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class='d-flex flex-row'>
        <img class='my-auto me-3 rounded-pill' alt='{{ Auth::user()->name }}' src='/img/user.png' height='75'
            width='75' />
        <div>
            <h3 class='fw-normal'>Welcome, {{ Auth::user()->name }}</h3>
            <p class="text-muted mb-0">These are your analytics stats for today {{ today()->format('F d, Y') }}</p>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-success text-white shadow-sm'>
                <h5 class='fw-normal'>SCHOOLS</h5>
                <h1>{{ $schools }} <i class="bi bi-building float-end"></i></h1>
                <p class="text-white mb-0">12% from last month</p>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-info shadow-sm'>
                <h5 class='fw-normal'>STUDENTS</h5>
                <h1>{{ $students }} <i class="bi bi-mortarboard float-end"></i></h1>
                <p class="text-muted mb-0">12% from last month</p>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-secondary text-white shadow-sm'>
                <h5 class='fw-normal'>STUDENT APPLICATIONS</h5>
                <h1>{{ $applications }} <i class="bi bi-collection float-end"></i></h1>
                <p class="text-white mb-0">12% from last month</p>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-warning shadow-sm'>
                <h5 class='fw-normal'>APPROVED</h5>
                <h1>0 <i class="bi bi-person-check float-end"></i></h1>
                <p class="text-muted mb-0">12% from last month</p>
            </div>
        </div>
    </div>
@endsection
