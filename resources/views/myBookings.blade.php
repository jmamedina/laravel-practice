@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
    
<h2 class="text-center mt-2 mb-2"> My Bookings </h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Booking id</th>
                <th scope="col">Appointment id</th>
                <th scope="col">Department Name</th>
                <th scope="col">Appointment Date</th>
                <th scope="col"> Cancel </th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <th scope="row">{{ $booking->id }}
                    <td> {{ $booking->appointment_id }}</td>
                    <td> {{ $booking->department_name }}</td>
                    <td> {{ $booking->appointment_date }}</td>
                    <td>
                        <form method ="post" action="{{ route('cancelBooking') }}">
                            @csrf
                            <input type="text" value="{{ $booking->id }}" name ="booking_id" style="display: none;"/>
                            <input type="text" value="{{ $booking->appointment_id }}" name ="appointment_id" style="display: none;"/>

                            <input type="submit" value="cancel" class ="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection