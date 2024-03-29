@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('application.index') }}">Student Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Application</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='w-75'>
            <form action='{{ route('application.update', $application->id) }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>Edit application details</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='first_name' placeholder='first name'
                            value='{{ $application->first_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='last_name' placeholder='last name'
                            value='{{ $application->last_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <select name="school" class="form-select mb-3">
                            <option value="{{ $application->school_id }}">{{ $application->school->name }}</option>
                            @foreach ($schools as $school)
                                <option value='{{ $school->id }}'>{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-md-4'>
                        <select name="combination" class="form-select mb-3">
                            <option value="{{ $application->combination_id }}">{{ $application->combination->name }}
                            </option>
                            @foreach ($combinations as $combination)
                                <option value='{{ $combination->id }}'>{{ $combination->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='mother' placeholder='Mother'
                            value='{{ $application->mother }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='father' placeholder='Father'
                            value='{{ $application->father }}' />
                    </div>
                    <div class='col-md-3'>
                        <select name="gender" class="form-select mbg-3">
                            <option value="{{ $application->gender }}">{{ $application->gender }}</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                    <div class='col-md-3'>
                        <input class='form-control mb-3' name='city' placeholder='city'
                            value='{{ $application->city }}' />
                    </div>
                    <div class='col-md-3'>
                        <input class='form-control mb-3' name='contact_person' placeholder='contact person name'
                            value='{{ $application->contact_person }}' />
                    </div>
                    <div class='col-md-3'>
                        <input class='form-control mb-3' name='contact_details' placeholder='contact details (phone, email)'
                            value='{{ $application->contact_details }}' />
                    </div>
                    <div class='col-md-4'>
                        <label for="dob">Date of birth</label>
                        <input class='form-control' name='dob' placeholder='date of birth' type='date'
                            value='{{ $application->dob }}' />
                    </div>
                    <div class="col-md-4">
                        <label for="image">Profile Picture</label>
                        <input class='form-control mb-3' name='image' type='file' accept="image/*" />
                    </div>
                    @if (in_array(Auth::user()->role, ['staff', 'admin']))
                        <div class='col-md-4'>
                            <label for="status">Status</label>
                            <select name="status" class="form-select mbg-3">
                                <option value="{{ $application->status }}">{{ $application->status }}</option>
                                <option value="pending">pending</option>
                                <option value="approved">approved</option>
                                <option value="rejected">rejected</option>
                            </select>
                        </div>
                    @endif
                </div>
                <textarea id='editor' class='form-control' name='description' placeholder="write more details">
                    {{ $application->description }}
                </textarea>
                @csrf @method('put')
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
                    <a href='{{ route('application.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All applications
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"));
    </script>
@endsection
