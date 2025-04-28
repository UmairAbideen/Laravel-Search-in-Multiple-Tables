<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <h2>Add User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('add.user') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">User Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="group_id" class="form-label">Group</label>
            <select name="group_id" id="group_id" class="form-select" required>
                <option value="">-- Select Group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Add User</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">⬅️ Back</a>
    </form>



</body>

</html>
