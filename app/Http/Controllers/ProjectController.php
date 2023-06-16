<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function getAllDepartments(Request $request)
    {
        $departments = Department::all();
        return view('index', ['departments' => $departments]);
    }

    public function showAppointments(Request $request)
    {
        $department_id = $request->input('department_id');
        $appointments = Appointment::where('department_id', '=', $department_id)->get();
        $appointmentDepartmentName = Appointment::groupBy('department_name')->where('department_id' , '=', $department_id)->get('department_name');

        $data['appointments']= $appointments;
        $data['departmentNames']= $appointmentDepartmentName[0]->department_name;
        return view('appointments',['data'=>$data]);
    }

    public function bookAppointment(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        $appointmentName = $request->input('department_name');
        $appointmentDate = $request->input('appointment_date');

        //check whethere the booking is already done or not
        $bookingExsists = Booking::where('appointment_id', '=', $appointmentId)->exists();

        if($bookingExsists){
            //tell user that it has been booked by someone
            Session::flash('message', 'Appointment was already booked');
            Session::flash('alert-class', 'alert-danger');

            //return to home
            return redirect('/');
        }else{
            //book the appointment
            
            $booking = new Booking;
            $booking->appointment_id = $appointmentId;
            $booking->department_name = $appointmentName;
            $booking->appointment_date = $appointmentDate;
            $booking->username = Auth::user()->name;
            $booking->user_id = Auth::user()->id;
            $booking->save();


            //change appointment Taken to 1

            Appointment::where('id', '=', $appointmentId)->update(['taken'=> 1]);

            //tell user that the appointment was booked
            Session::flash('message', 'Appointment booked successfully');
            Session::flash('alert-class', 'alert-success');

            //return to home
            return redirect('/');
        }
    }

    public function myBookings(Request $request){

        $bookings = Booking::where('user_id', '=', Auth::user()->id)->get();
        return \view('myBookings', ['bookings'=>$bookings]);

    }

    public function cancelBooking(Request $request){
        $bookingId = $request->input('booking_id');
        $appointmentId = $request->input('appointment_id');

        Booking::where('id', '=', $bookingId)->delete();
        Appointment::where('id', '=', $appointmentId)->update(['taken'=> 0]);

        Session::flash('message', 'Booking cancelled');
        Session::flash('alert-class', 'alert-success');

        return redirect('/');

    }

}
