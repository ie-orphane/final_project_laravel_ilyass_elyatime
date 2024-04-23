<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 h-full hidden sm:block">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col py-20 items-center h-screen">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:-my-px sm:mt-10 sm:flex">
                <x-nav-link class="flex-col" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    @if (request()->routeIs('dashboard'))
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="text-gray-900 dark:text-gray-100 size-7">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                    @endif
                    {{ __('Dashboard') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:-my-px sm:mt-10 sm:flex">
                <x-nav-link class="flex-col" :href="route('tasks')" :active="request()->routeIs('tasks')">
                    @if (request()->routeIs('tasks'))
                        <svg viewBox="0 0 32 32" class="size-7 text-gray-900 dark:text-gray-100"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <rect fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" height="25" rx="2" width="10" x="4" y="1">
                            </rect>
                            <rect fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" height="18" rx="2" width="10" x="19" y="1">
                            </rect>
                        </svg>
                    @else
                        <svg viewBox="0 0 32 32" class="size-7 text-gray-500 dark:text-gray-400"
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
        </div>
    </div>
</nav
