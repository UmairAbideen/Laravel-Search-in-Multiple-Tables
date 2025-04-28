<!DOCTYPE html>
<html>

<head>
    <title>Add Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
</head>

<body class="p-4">
    <h2>Add Car</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('add.car') }}">
        @csrf

        <!-- Group Dropdown -->
        <div class="mb-3">
            <label for="group_id" class="form-label">Select Group</label>
            <select name="group_id" id="group_id" class="form-select" required>
                <option value="">-- Select Group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- User Dropdown (Initially Empty) -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Select User --</option>
            </select>
        </div>

        <!-- Car Make -->
        <div class="mb-3">
            <label for="make" class="form-label">Car Make</label>
            <input type="text" name="make" class="form-control" required>
        </div>

        <!-- Car Model -->
        <div class="mb-3">
            <label for="model" class="form-label">Car Model</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <button class="btn btn-primary">Add Car</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">⬅️ Back</a>
    </form>

    <script>
        // When the group is changed, update the user dropdown
        $('#group_id').on('change', function() {
            var groupId = $(this).val();

            // Clear the user dropdown before fetching new users
            $('#user_id').empty();
            $('#user_id').append('<option value="">-- Select User --</option>');

            // Make AJAX request to fetch users based on the selected group
            if (groupId) {
                $.ajax({
                    url: '/fetch-users/' + groupId, // Adjust to match your route
                    type: 'GET',
                    success: function(response) {
                        // Populate the user dropdown with the fetched users
                        $.each(response.users, function(index, user) {
                            $('#user_id').append('<option value="' + user.id + '">' + user
                                .name + '</option>');
                        });
                    }
                });
            }
        });
    </script>

</body>

</html>
