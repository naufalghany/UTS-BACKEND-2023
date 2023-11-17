<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // Membuat method index
    public function index()
    {
        // Menggunakan Model Employees untuk select data
        $employee = Employee::all();
        $data = [
            'message' => 'Get All Employee',
            'data' => $employee
        ];

        // jika data kosong
        if ($employee->isEmpty()) {
            $data = [
                'message' => 'kosong',
            ];
            return response()->json($data, 204);
        }

        // Mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

    // Membuat method find dengan id
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            $data = [
                'message' => 'Data not found'
            ];
            return response()->json($data, 404);
        }
        $data = [
            'message' => 'Show detail resource',
            'data' => $employee
        ];
        return response()->json($data, 200);
    }
    // Menambahkan method store 
    public function store(Request $request)
    {

        // validasi data request
        $validatedData = $request->validate([
            "name" => "required",
            "gender" => "required",
            "phone" => "required",
            "address" => "required",
            "email" => "email|required",
            "status" => "required",
            "hired_on" => "required",
        ]);

        // Menggunakan model 
        $employee = Employee::create($validatedData);

        $data = [
            'message' => 'Employee is created succesfully',
            'data' => $employee,
        ];

        // Mengembalikan data (JSON) dan kode 201
        return response()->json($data, 201);
    }

    // Membuat method update
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Employee not found'
            ];
            return response()->json($data, 404);
        }

        $employee->update([
            'name' => $request->name ?? $employee->name,
            'gender' => $request->gender ?? $employee->gender,
            'phone' => $request->phone ?? $employee->phone,
            'address' => $request->address ?? $employee->address,
            'email' => $request->email ?? $employee->email,
            'status' => $request->status ?? $employee->status,
            'hired_on' => $request->hired_on ?? $employee->hired_on

        ]);
        $data = [
            'message' => 'Employee is updated successfully',
            'data' => $employee,
        ];

        return response()->json($data, 200);
    }

    // Method untuk menghapus karyawan dengan id
    public function destroy($id)
    {

        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        $data = [
            'message' => 'Employee has been deleted successfully',
        ];

        return response()->json($data, 200);
    }


    // Menambahkan method untuk mencari karyawan berdasarkan nama
    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
        ]);

        // Menggunakan Model Employee untuk melakukan pencarian berdasarkan nama
        $employee = Employee::where('name', 'like', '%' . $request->input('name') . '%')->get();

        // Jika tidak ada karyawan yang ditemukan
        if ($employee->isEmpty()) {
            $data = [
                'message' => 'Tidak ada karyawan yang ditemukan dengan nama tersebut',
            ];
            return response()->json($data, 404);
        }

        // Mengirim data (json) dan kode 200
        $data = [
            'message' => 'Search Employee by Name',
            'data' => $employee,
        ];
        return response()->json($data, 200);
    }

    // Menambahkan method untuk mendapatkan karyawan yang aktif
    public function active()
    {
        // Menggunakan Model Employee untuk select data karyawan yang aktif
        $activeEmployee = Employee::where('status', 'aktif')->get();

        // Jika tidak ada karyawan yang aktif
        if ($activeEmployee->isEmpty()) {
            $data = [
                'message' => 'Tidak ada karyawan yang aktif',
            ];
            return response()->json($data, 204);
        }

        // Mengirim data (json) dan kode 200
        $data = [
            'message' => 'Get Active Employee',
            'data' => $activeEmployee,
        ];
        return response()->json($data, 200);
    }

    // Menambahkan method untuk mendapatkan karyawan yang tidak aktif
    public function inactive()
    {
        // Menggunakan Model Employees untuk select data karyawan yang aktif
        $inactiveEmployee = Employee::where('status', 'tidak aktif')->get();

        // Jika tidak ada karyawan yang aktif
        if ($inactiveEmployee->isEmpty()) {
            $data = [
                'message' => 'Semua karyawan aktif',
            ];
            return response()->json($data, 204);
        }

        // Mengirim data (json) dan kode 200
        $data = [
            'message' => 'Get Inactive Employee',
            'data' => $inactiveEmployee,
        ];
        return response()->json($data, 200);
    }

    // Menambahkan method untuk mendapatkan karyawan yang terminated
    public function terminated()
    {
        // Menggunakan Model Employees untuk select data karyawan yang aktif
        $terminEmployee = Employee::where('status', 'terminated')->get();

        // Jika tidak ada karyawan yang aktif
        if ($terminEmployee->isEmpty()) {
            $data = [
                'message' => 'Tidak ada karyawan yang dipecat',
            ];
            return response()->json($data, 204);
        }

        // Mengirim data (json) dan kode 200
        $data = [
            'message' => 'Get Terminated Employee',
            'data' => $terminEmployee,
        ];
        return response()->json($data, 200);
    }

}