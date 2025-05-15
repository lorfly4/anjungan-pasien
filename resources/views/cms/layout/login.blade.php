<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm p-6 bg-white rounded shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-700">Login</h2>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.proseslogin') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded" required value="{{ old('email') }}">
            </div>

            <div class="mb-6">
                <label class="block mb-1 text-sm font-medium text-gray-600">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
            </div>


            <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</body>
</html>
