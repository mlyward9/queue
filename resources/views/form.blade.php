<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4">User Form</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('form.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm/6 font-medium text-gray-900">Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Gender</label>
                <select name="gender" class="w-full p-2 border rounded" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Purpose</label>
                <div class="grid grid-cols-1 gap-2">
                    <label><input type="checkbox" name="purpose[]" value="e-registration"> E-Registration</label>
                    <label><input type="checkbox" name="purpose[]" value="oec"> OEC</label>
                    <label><input type="checkbox" name="purpose[]" value="information_sheet"> Information Sheet</label>
                    <label><input type="checkbox" name="purpose[]" value="welfare_and_registration"> Welfare and Registration Division</label>
                    <label><input type="checkbox" name="purpose[]" value="direct_hire"> Direct Hire</label>
                    <label><input type="checkbox" name="purpose[]" value="SENA"> SENA</label>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
        </form>
    </div>
</body>
</html>
