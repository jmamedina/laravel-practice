@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
    
<h2 class="text-center"> {{ $data['departmentNames'] }} Appointments </h2>
    <table class="table table-hover" style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Department Name</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Taken</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['appointments'] as $appointment)
                <tr>
                    <th scope="row">{{ $appointment->id }}
                    <td> {{ $appointment->department_name }}</td>
                    <td> {{ $appointment->appointment_date }}</td>
                    @if($appointment->taken)
                        <td> Booked </td>
                    @else
                        <td>
                            <form method="post"  action="{{ route('bookAppointment') }}">
                                @csrf
                                <input type="text" value="{{ $appointment->id }}" name ="appointment_id" style="display:none;"/>
                                <input type="text" value="{{ $appointment->department_name }}" name ="department_name"  style="display:none;"/>
                                <input type="text" value="{{ $appointment->appointment_date }}" name ="appointment_date"  style="display:none;"/>

                                <input type="submit" value="book" class="btn btn-primary"/>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection