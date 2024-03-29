@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Application</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All student applications</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('application.create') }}'>
                <i class='bi bi-plus'></i> Add application
            </a>
        </span>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Birth Date</th>
                <th scope="col">School</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $key => $application)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        @if ($application->image)
                            <img alt='{{ $application->first_name }}' src='{{ asset('storage/' . $application->image) }}'
                                width='40' height='40' style='object-fit:cover' class='rounded-pill me-1' />
                        @endif
                        {{ $application->first_name }} {{ $application->last_name }}
                    </td>
                    <td>
                        <span class='badge {{ $colors[$application->status] }}'>
                            {{ $application->status }}
                        </span>
                    </td>
                    <td>{{ $application->dob }}</td>
                    <td>{{ $application->school->name }}</td>
                    <td>{{ $application->contact_person }} {{ $application->contact_details }}</td>
                    <td>
                        @if (Auth::user()->role == 'sponsor')
                            <div class='btn-group'>
                                <a class='btn btn-sm btn-success' href='{{ route('application.show', $application->id) }}'>
                                    <i class='bi bi-eye'></i>
                                </a>
                                <a href='{{ route('application.support', $application->id) }}' class='btn btn-sm btn-info'
                                    data-toggle="tooltip" title="Sponsor child">
                                    <i class='bi bi-check'></i>
                                </a>
                            </div>
                        @endif
                        @if (in_array(Auth::user()->role, ['admin', 'staff']))
                            <div class='btn-group'>
                                <a class='btn btn-sm btn-success' href='{{ route('application.show', $application->id) }}'>
                                    <i class='bi bi-eye'></i>
                                </a>
                                <a class='btn btn-sm btn-info' href='{{ route('application.edit', $application->id) }}'>
                                    <i class='bi bi-pencil'></i>
                                </a>
                            </div>
                        @endif
                        <form action='{{ route('application.destroy', $application->id) }}' method='post'
                            class='d-inline'>
                            @csrf @method('delete')
                            <button class='btn btn-sm btn-warning'>
                                <i class='bi bi-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $applications->links() }}
@endsection
