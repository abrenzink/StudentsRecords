<!DOCTYPE html>
<html>
<head>
    <title>Student Records Dashboard</title>

    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        h2 { margin-top: 40px; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>

    <h1>Student Records Dashboard</h1>

    <!-- Success message -->
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <!-- Validation errors -->
    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Create new student -->
    <h2>Add New Student</h2>
    <form method="POST" action="{{ route('dashboard.students.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="enrollment_date" required>
        <button type="submit">Add Student</button>
    </form>

    <!-- Students table with their grades -->
    <h2>Students List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment Date</th>
                <th>Student Code</th>
                <th>Grades</th>
                <th>Add Grade</th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->enrollment_date }}</td>
                <td>{{ $student->student_code }}</td>

                <!-- Show student grades -->
                <td>
                    <ul>
                        @foreach($grades as $g)
                            @if($g->student_id == $student->id)
                                <li>{{ $g->course_name }}: {{ $g->grade }}</li>
                            @endif
                        @endforeach
                    </ul>
                </td>

                <!-- Form to add a new grade for this student -->
                <td>
                    <form method="POST" action="{{ route('dashboard.grades.store', $student->id) }}">
                        @csrf
                        <select name="course_id" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>

                        <input type="number" name="grade" step="0.01" placeholder="Grade" required>
                        <button type="submit">Add Grade</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Student report summary -->
    <h2>Reports by Student</h2>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Average Grade</th>
                <th>Highest Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $r)
            <tr>
                <td>{{ $r->student_id }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ number_format($r->avg_grade, 2) }}</td>
                <td>{{ $r->max_grade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Course report summary -->
    <h2>Reports by Course</h2>
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Average Grade</th>
                <th>Max Grade</th>
                <th>Min Grade</th>
                <th>Total Grades</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseReports as $c)
            <tr>
                <td>{{ $c->course_name }}</td>
                <td>{{ number_format($c->avg_grade, 2) }}</td>
                <td>{{ $c->max_grade }}</td>
                <td>{{ $c->min_grade }}</td>
                <td>{{ $c->total_grades }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
