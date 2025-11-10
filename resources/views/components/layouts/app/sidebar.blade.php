<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
           @php
                $user = auth()->user();

                $eneagrama = $user?->eneagrama;
                $preguntas = $eneagrama?->preguntas ?? collect();
                $frases    = $eneagrama?->frases ?? collect();
                $verbos    = $eneagrama?->verbos ?? collect();

                $tieneEneagrama = $user && $eneagrama && $preguntas->isNotEmpty();
            @endphp
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Principal') }}</flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-check" :href="route('eneagrama.listado')" :current="request()->routeIs('eneagrama.listado')" wire:navigate>{{ __('Eneagramas') }}</flux:navlist.item>
                    <!-- Parent: Formulario -->

                   @if ($tieneEneagrama)
                    <!-- Bloque con submenú (Formulario con hijos) -->
                    @if ($tieneEneagrama)
    <!-- Bloque con submenú -->
    <div x-data="{ open: {{ request()->routeIs('eneagramas.form') ? 'true' : 'false' }} }" class="space-y-1">
        <button
            @click="open = !open"
            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-800 rounded transition"
        >
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <x-flux::icon name="pencil-square" class="w-5 h-5" />
                <span>{{ __('Formulario') }}</span>
            </div>
            <svg x-bind:class="{ 'rotate-90': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <div x-show="open" x-transition class="pl-9 space-y-1 mt-1">
            <flux:navlist.item
                icon="question-mark-circle"
                :href="route('eneagramas.form', 'preguntas')"
                :current="request()->routeIs('eneagramas.form') && request()->route('seccion') === 'preguntas'"
                wire:navigate
            >
                {{ __('Preguntas') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="chat-bubble-oval-left"
                :href="route('eneagramas.form', 'frases')"
                :current="request()->routeIs('eneagramas.form') && request()->route('seccion') === 'frases'"
                wire:navigate
            >
                {{ __('Frases') }}
            </flux:navlist.item>

            <flux:navlist.item
                icon="language"
                :href="route('eneagramas.form', 'verbos')"
                :current="request()->routeIs('eneagramas.form') && request()->route('seccion') === 'verbos'"
                wire:navigate
            >
                {{ __('Verbos') }}
            </flux:navlist.item>
        </div>
    </div>
@else
    <!-- Solo el acceso al formulario simple -->
    <flux:navlist.item
        icon="pencil-square"
        :href="route('eneagrama.formulario')"
        :current="request()->routeIs('eneagrama.formulario')"
        wire:navigate
    >
        {{ __('Formulario') }}
    </flux:navlist.item>
@endif

                    @else
                        <!-- Solo el acceso al formulario simple -->
                        <flux:navlist.item
                            icon="pencil-square"
                            :href="route('eneagrama.formulario')"
                            :current="request()->routeIs('eneagrama.formulario')"
                            wire:navigate
                        >
                            {{ __('Formulario') }}
                        </flux:navlist.item>
                    @endif
                    <flux:navlist.item icon="link" :href="route('eneagrama.pagina')" :current="request()->routeIs('eneagrama.pagina')" wire:navigate>{{ __('Tu página') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @stack('scripts')
        @fluxScripts
    </body>
</html>
