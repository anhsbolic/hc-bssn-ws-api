<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use Illuminate\Http\Request;
use Str;

class ArrivalController extends Controller
{
    public function store(Request $request)
    {
        $photoPath = $request->file('photo')->move(
            public_path('uploads/photo'),
            $request->file('photo')->getClientOriginalName()
        );

        $vaccinePath = $request->file('vaccine_certificate')->move(
            public_path('uploads/vaccine'),
            $request->file('vaccine_certificate')->getClientOriginalName()
        );

        $arrival = Arrival::create([
            'id' => Str::uuid(),
            'full_name' => $request->input('full_name'),
            'passport_number' => $request->input('passport_number'),
            'nationality' => $request->input('nationality'),
            'gender' => $request->input('gender'),
            'birth_date' => $request->input('birth_date'),
            'photo_path' => $photoPath,
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'stay_address' => $request->input('stay_address'),
            'flight_number' => $request->input('flight_number'),
            'arrival_date' => $request->input('arrival_date'),
            'origin_city' => $request->input('origin_city'),
            'destination_city' => $request->input('destination_city'),
            'health_history' => $request->input('health_history'),
            'emergency_contact_name' => $request->input('emergency_contact_name'),
            'emergency_contact_phone' => $request->input('emergency_contact_phone'),
            'vaccine_certificate_path' => $vaccinePath
        ]);

        return response()->json([
            'id' => $arrival->id,
            'message' => 'Pendaftaran berhasil'
        ], 201);
    }

    public function show($id)
    {
        return Arrival::findOrFail($id);
    }

    public function index()
    {
        return Arrival::all();
    }

    public function verify(Request $request, $id)
    {
        $arrival = Arrival::findOrFail($id);
        $arrival->status = 'approved';
        $arrival->approved_by_user_id = $request->input('user_id');
        $arrival->save();

        return response()->json(['message' => 'Data verified']);
    }

    public function reject(Request $request, $id)
    {
        $arrival = Arrival::findOrFail($id);
        $arrival->status = 'rejected';
        $arrival->reject_reason = $request->input('reject_reason');
        $arrival->rejected_by_user_id = $request->input('user_id');
        $arrival->save();

        return response()->json(['message' => 'Data rejected']);
    }
}
