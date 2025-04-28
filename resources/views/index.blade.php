<!DOCTYPE html>
<html>

<head>
    <title>User Car Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="p-4">
    <h2>User Car Search</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <!-- Add Group Button -->
        <a href="{{ route('add.group.form') }}" class="btn btn-info">➕ Add Group</a>
        <a href="{{ route('add.user.form') }}" class="btn btn-primary">➕ Add User</a>
        <a href="{{ route('add.car.form') }}" class="btn btn-secondary">🚗 Add Car</a>
    </div>

    <!-- Search form -->
    <form action="{{ route('search') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <!-- Group filter dropdown -->
            <select name="group_id" id="group_id" class="form-select" required>
                <option value="">-- Select Group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <!-- User filter dropdown, will be dynamically updated -->
            <select name="user_id" id="user_id" class="form-select">
                <option value="">-- Select User (optional) --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success">🔍 Search</button>
        </div>
    </form>

    @if ($selectedUser)
        <!-- If a specific user is selected, show that user's cars -->
        <h4>{{ $selectedUser->name }}'s Cars:</h4>
        @if ($selectedUser->cars->isEmpty())
            <p>No cars found for {{ $selectedUser->name }}.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Car Name</th>
                        <th>Car Model</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedUser->cars as $index => $car)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $car->make }}</td>
                            <td>{{ $car->model }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @else
        <!-- If no specific user is selected, show all users from the selected group -->
        @if ($users->isEmpty())
            <p>No users found in this group.</p>
        @else
            <h4>Users in the selected group:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Cars</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if ($user->cars->isEmpty())
                                    No cars
                                @else
                                    @foreach ($user->cars as $car)
                                        <p>{{ $car->make }} - {{ $car->model }}</p>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif

    <script>
        // When the group dropdown changes, update the users dropdown via AJAX
        $('#group_id').change(function() {
            var groupId = $(this).val();
            if (groupId) {
                // Make AJAX request to fetch users for the selected group
                $.ajax({
                    url: '{{ route('get.users.by.group') }}', // Your new route
                    type: 'GET',
                    data: {
                        group_id: groupId
                    },
                    success: function(response) {
                        // Clear existing users and append the new ones
                        $('#user_id').empty();
                        $('#user_id').append('<option value="">-- Select User (optional) --</option>');
                        $.each(response.users, function(index, user) {
                            $('#user_id').append('<option value="' + user.id + '">' + user
                                .name + '</option>');
                        });
                    }
                });
            } else {
                // If no group is selected, clear the user dropdown
                $('#user_id').empty();
                $('#user_id').append('<option value="">-- Select User (optional) --</option>');
            }
        });
    </script>

</body>

</html>
