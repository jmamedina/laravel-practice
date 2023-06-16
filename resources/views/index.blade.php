@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
    <div class="row mt-5">

    @if(Session::has('message'))
    <p class="alert{{ Session::get('alert-class', 'alert-success') }}"> {{Session::get('message')}}</p>
    @endif

    @foreach($departments as $department)
        <div class="col-lg-4 col-md4 col-sm-12 text-center mb-3"> 
            <div class="card" style="width:18rem;">

                <div class="card-body">
                    <img src="{{ $department->image }}" style="width: 200px;margin: 0 auto;"/>
                    <div class="card-title">{{ $department->name }}  </div>
                    <div class="card-text"> {{ $department->description }}content</div>

                    <form method="post" action="{{ route('showAppointments') }}" class="mt-3 mb-2">
                        @csrf
                        <input type="text" name="department_id" value="{{ $department->id }}" style="display:none;"/>
                        <input type="submit" value="Show Appointments" class="btn btn-primary" />
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

@endsection