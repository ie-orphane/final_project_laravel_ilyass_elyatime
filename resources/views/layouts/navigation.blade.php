<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 h-full hidden sm:block">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col py-20 items-center h-screen">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:-my-px sm:mt-10 sm:flex">
                <x-nav-link class="items-center gap-2" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    @if (request()->routeIs('dashboard'))
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="text-gray-900 dark:text-gray-100 size-6">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    @endif
                    {{ __('Dashboard') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:-my-px sm:mt-10 sm:flex">
                <x-nav-link class="items-center gap-2" :href="route('tasks')" :active="request()->routeIs('tasks') || request()->routeIs('tasks.show')">
                    @if (request()->routeIs('tasks') || request()->routeIs('tasks.show'))
                        <svg viewBox="0 0 32 32" class="size-6 text-gray-900 dark:text-gray-100"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <rect fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" height="25" rx="2" width="10" x="4" y="1">
                            </rect>
                            <rect fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" height="18" rx="2" width="10" x="19" y="1">
                            </rect>
                        </svg>
                    @else
                        <svg viewBox="0 0 32 32" class="size-6 text-gray-500 dark:text-gray-400"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <rect fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                height="25" rx="2" width="10" x="4" y="1">
                            </rect>
                            <rect fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                height="18" rx="2" width="10" x="19" y="1">
                            </rect>
                        </svg>
                    @endif
                    {{ __('Tasks') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:-my-px sm:mt-10 sm:flex">
                <x-nav-link class="items-center gap-2" :href="route('teams')" :active="request()->routeIs('teams')|| request()->routeIs('teams.show')">
                    @if (request()->routeIs('teams')|| request()->routeIs('teams.show'))
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6 text-gray-900 dark:text-gray-100">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    @endif
                    {{ __('Teams') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</nav
