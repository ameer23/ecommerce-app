<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a new account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
        <form class="space-y-6" wire:submit="register">
            {{-- Name Input --}}
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input wire:model.blur="name" id="name" name="name" type="text" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('name') ring-red-500 @enderror">
                </div>
                @error('name') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>

            {{-- Email Input --}}
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input wire:model.live="email" id="email" name="email" type="email" autocomplete="email" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('email') ring-red-500 @enderror">
                </div>
                @error('email') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>

            {{-- Password Input --}}
            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input wire:model.live="password" id="password" name="password" type="password" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('password') ring-red-500 @enderror">
                </div>
                @error('password') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
                
                <div class="mt-2 flex space-x-1">
                    <div class="h-2 rounded-full w-1/4 {{ $this->passwordStrength() > 0 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    <div class="h-2 rounded-full w-1/4 {{ $this->passwordStrength() > 1 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    <div class="h-2 rounded-full w-1/4 {{ $this->passwordStrength() > 2 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                    <div class="h-2 rounded-full w-1/4 {{ $this->passwordStrength() > 3 ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                <div class="mt-2">
                    <input wire:model.live="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6 @error('password_confirmation') ring-red-500 @enderror">
                </div>
                @error('password_confirmation') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Register
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-black hover:text-gray-800">Sign in</a>
        </p>
    </div>
</div>