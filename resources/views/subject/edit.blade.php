@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('subject.index') }}">Subject</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='text-center w-75'>
            <form action='{{ route('subject.update', $subject->id) }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>Edit subject details</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-6'>
                        <input class='form-control mb-3' name='name' placeholder='subject name'
                            value='{{ $subject->name }}' />
                    </div>
                    <div class="col-md-6">
                        <input class='form-control mb-3' name='image' type='file' accept="image/*" />
                    </div>
                </div>
                <textarea id='editor' class='form-control' name='description' placeholder="write more details">
                    {{ $subject->description }}
                </textarea>
                @csrf @method('put')
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
                    <a href='{{ route('subject.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All subjects
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
