@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Student Records - College</h2>

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
                            <td>New Regular</td>
                            <td>Cruz, Juan D.</td>
                            <td>Bachelor of Science in Computer Science</td>
                            <td>1st Year | Main Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Oct 10, 2024 at 2:30 PM</td>
                        </tr>
                        <tr>
                            <td>Transferee</td>
                            <td>Reyes, Maria S.</td>
                            <td>Bachelor of Science in Accountancy</td>
                            <td>2nd Year | Bulacan Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Sep 25, 2024 at 10:15 AM</td>
                        </tr>
                        <tr>
                            <td>Returnee</td>
                            <td>Lopez, Pedro G.</td>
                            <td>Bachelor of Secondary Education</td>
                            <td>3rd Year | Main Branch</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>Aug 15, 2024 at 3:45 PM</td>
                        </tr>
                        <tr>
                            <td>New Regular</td>
                            <td>Flores, Ana T.</td>
                            <td>Bachelor of Science in Nursing</td>
                            <td>4th Year | Bulacan Branch</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Oct 05, 2024 at 11:20 AM</td>
                        </tr>
                        <tr>
                            <td>Transferee</td>
                            <td>Morales, Carlos R.</td>
                            <td>Bachelor of Arts in Psychology</td>
                            <td>1st Year | Main Branch</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>Sep 20, 2024 at 4:10 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
