<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        form { display: inline; }
    </style>
</head>
<body>
    <h1>Students</h1>

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

    <!-- Create new student form -->
    <h2>Add New Student</h2>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="enrollment_date" required>
        <button type="submit">Add</button>
    </form>

    <!-- Students table -->
    <h2>Students List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Enrollment Date</th>
                <th>Student Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <!-- Loop through all students -->
            @foreach($students as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->enrollment_date }}</td>
                <td>{{ $s->student_code }}</td>
                <td>

                    <!-- Edit link -->
                    <a href="{{ route('students.edit', $s->id) }}">Edit</a>

                    <!-- Delete form -->
                    <form method="POST" action="{{ route('students.destroy', $s->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this student?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>
