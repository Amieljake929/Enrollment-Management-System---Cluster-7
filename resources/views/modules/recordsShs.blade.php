@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Student Records - SHS</h2>

    <!-- Student Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Student Type</th>
                            <th>Student Names</th>
                            <th>Course</th>
                            <th>Year Level | Branch</th>
                            <th>Status</th>
                            <th>Admission Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Regular</td>
                            <td>Dela Cruz, Juan P.</td>
                            <td>STEM</td>
                            <td>Grade 11 | Main Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Aug 15, 2023 at 10:00 AM</td>
                        </tr>
                        <tr>
                            <td>Regular</td>
                            <td>Santos, Maria L.</td>
                            <td>ABM</td>
                            <td>Grade 12 | Bulacan Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Aug 20, 2023 at 2:30 PM</td>
                        </tr>
                        <tr>
                            <td>Regular</td>
                            <td>Reyes, Pedro A.</td>
                            <td>HUMSS</td>
                            <td>Grade 11 | Main Branch</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>Sep 5, 2023 at 11:15 AM</td>
                        </tr>
                        <tr>
                            <td>Regular</td>
                            <td>Gonzales, Ana R.</td>
                            <td>TVL</td>
                            <td>Grade 12 | Bulacan Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Sep 10, 2023 at 9:45 AM</td>
                        </tr>
                        <tr>
                            <td>Regular</td>
                            <td>Lopez, Carlos M.</td>
                            <td>STEM</td>
                            <td>Grade 11 | Main Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Oct 1, 2023 at 1:00 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
