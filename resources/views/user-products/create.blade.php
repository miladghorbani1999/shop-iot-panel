<x-app-layout>
    <div>
        {{--Breadcrumb start--}}
        <div class="mb-6">
            {{--BreadCrumb--}}
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle"/>
        </div>
        {{--Breadcrumb end--}}

        {{--Create user form start--}}
        <form method="POST" action="{{ route('users.store') }}" class="max-w-4xl m-auto">
            @csrf
            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">

                <div class="grid sm:grid-cols-1 gap-x-8 gap-y-4">

                    <div class="alert alert-danger light-mode" id="alert-danger" hidden>
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <iconify-icon class="text-2xl flex-0" icon="system-uicons:target"></iconify-icon>
                            <p class="flex-1 font-Inter" id="text-alert"> This is an alert—check it out! </p>
                            <div class="flex-0 text-xl cursor-pointer">
                                <iconify-icon icon="line-md:close" class="relative top-[4px]"></iconify-icon>
                            </div>
                        </div>
                    </div>
                    {{--Name input end--}}
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input name="name" type="text" id="name" class="form-control"
                               placeholder="{{ __('Enter your name') }}" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    {{--Email input start--}}
                    <div class="input-area">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input name="email" type="email" id="email" class="form-control"
                               placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    {{--Email input start--}}
                    <div class="input-area">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input name="password" type="password" id="password" class="form-control"
                               placeholder="{{ __('Enter Password') }}">
                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    {{--Password input end--}}
                    {{--Role input start--}}
                    <div class="input-area">
                        <label for="role" class="form-label">{{ __('Role') }}</label>
                        <select name="role" class="form-control">
                            <option value="" selected disabled>
                                {{ __('Select Role') }}
                            </option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <iconify-icon class="absolute right-3 bottom-3 text-xl dark:text-white z-10"
                                      icon="material-symbols:keyboard-arrow-down-rounded"></iconify-icon>
                    </div>
                    {{--Role input end--}}
                    {{--Email input start--}}
                    <div class="input-area">
                        <label for="rfid" class="form-label">{{ __('rfid code') }}</label>
                        <input name="rfid" type="text" id="rfid" class="form-control"
                               placeholder="{{ __('Waite for rfid') }}" value="{{ old('rfid') }}" required>
                        <x-input-error :messages="$errors->get('rfid')" class="mt-2"/>
                    </div>


                    {{--Email input start--}}
                </div>
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-full">
                    {{ __('Save') }}
                </button>
            </div>

        </form>
        {{--Create user form end--}}
    </div>
</x-app-layout>
<script>
    document.getElementById('alert-danger').hidden = true;
    const interval = setInterval(function () {
        let data = window.axios
            .get('http://0.0.0.0:8000/api/rfid')
            .then(function (response) {
                document.getElementById('rfid').value = response.data.message;
            })
            .catch(function (response) {

                document.getElementById('text-alert').innerHTML = response.response.data.message;

                console.log(response.response.data.message)
            })
        document.getElementById('alert-danger').hidden = document.getElementById('rfid').value.length > 0;
    }, 10000);

</script>
