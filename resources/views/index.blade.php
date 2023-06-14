@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
    <div class="row mt-5">

    @foreach($departments as $department)
        <div class="col-lg-4 col-md4 col-sm-12 text-center mb-3"> 
            <div class="card" style="width: 18rem;">
                <div class="card-title"> </div>
                <div class="card-text"> content</div>
            </div>
        </div>

        
    </div>
    @endforeach
</div>

@endsection