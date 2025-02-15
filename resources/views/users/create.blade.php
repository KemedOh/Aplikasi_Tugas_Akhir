<main class="login-form">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h2 class="font-semibold text-lg">Create Category</h2>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" name="name" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @if ($errors->has('name'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" id="email" name="email" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @if ($errors->has('email'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @if ($errors->has('password'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @if ($errors->has('password'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select id="role_id" name="role_id" class="block mt-1 w-full" required>
                                    <option value="" disabled selected>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('password'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>