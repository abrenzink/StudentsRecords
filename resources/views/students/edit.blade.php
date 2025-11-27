<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>

    <!-- Validation errors -->
    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Edit student form -->
    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')

        <!-- Student name -->
        <input type="text" name="name" value="{{ $student->name }}" required>

        <!-- Student email -->
        <input type="email" name="email" value="{{ $student->email }}" required>

        <!-- Enrollment date -->
        <input type="date" name="enrollment_date" value="{{ $student->enrollment_date }}" required>

        <button type="submit">Update</button>
    </form>

    <!-- Link back to list -->
    <p><a href="{{ route('students.index') }}">Back to Students List</a></p>
</body>
</html>
