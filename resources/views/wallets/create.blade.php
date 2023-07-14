<x-app-layout>
    <div>

        {{--Create user form start--}}
        <form method="POST" action="{{ route('wallets.store') }}" class="max-w-4xl m-auto">
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
                        <label for="amount" class="form-label">{{ __('Amount') }}</label>
                        <input name="amount" type="text" id="amount" class="form-control"
                               placeholder="{{ __('Enter your amount for increment account') }}" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                </div>
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-full">
                    {{ __('Pay') }}
                </button>
            </div>

        </form>
        {{--Create user form end--}}
    </div>
</x-app-layout>
<script>
</script>
