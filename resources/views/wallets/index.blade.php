<x-app-layout>
    <div class="space-y-8">
        <!-- START:: wallets -->
        <div class="card p-6">
            <div class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center">
                <div class="flex space-x-4 h-full items-center rtl:space-x-reverse">
                    <div class="flex-none">
                        <div class="h-20 w-20 rounded-full">
                            <img src="images/all-img/main-user.png" alt="" class="w-full h-full">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-medium mb-2">
                            <span class="block font-light">{{__('Name')}}</span>
                            <span class="block">{{$user->name}}</span>
                        </h4>
                        {{--                        <p class="text-sm dark:text-slate-300">Welcome to Dashcode</p>--}}
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-900 rounded p-4">
                    <div class="text-slate-600 dark:text-slate-400 text-sm mb-1 font-medium">
                        {{__('Current balance')}}
                    </div>
                    <div class="text-slate-900 dark:text-white text-lg font-medium">
                        {{$user->balance}}تومان
                    </div>
                    <div class="ml-auto max-w-[124px]">
                        <div id="clmn_chart_1"></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END:: wallets -->
        <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-5">
            <div class="mt-7 p-6 relative z-[1] rounded-2xl text-white bg-slate-900 dark:bg-slate-800">
                <div class="max-w-[168px]">
                    <div class="widget-title">{{__('Inventory Increment')}}</div>
                    <div class="text-2xs font-normal pt-4 whitespace-nowrap"> {{__("For Increment Wallet Click")}} </div>
                </div>
                <div class="mt-6 mb-14">
                    <a href="{{route('wallets.create')}}" class="btn bg-white hover:bg-opacity-80 text-slate-900 btn-sm"> {{__("Increment")}} </a>
                </div> <img src="images/svg/line.svg" alt="" class="absolute left-0 bottom-0 w-full z-[-1]"> <img src="images/svg/rabit.svg" alt="" class="absolute ltr:right-5 rtl:left-5 -bottom-4 z-[-1]">
            </div>
        </div>
    </div>

</x-app-layout>
