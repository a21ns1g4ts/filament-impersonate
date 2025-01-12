@props(['style', 'display', 'fixed', 'position'])

@if (app('impersonate')->isImpersonating())
    @php
        $style = $style ?? config('filament-impersonate.banner.style');
        $display = $display ?? Filament\Facades\Filament::getUserName(auth()->user());
        $fixed = $fixed ?? config('filament-impersonate.banner.fixed');
        $position = $position ?? config('filament-impersonate.banner.position');
    @endphp

    <style>
        body .fi-main-ctn {
            @if ($fixed || $position == 'top')
                @if ($position == 'top')
                    padding-top: 50px;
                @else
                    padding-bottom: 50px;
                @endif
            @endif
        }

        body .fi-topbar {
            @if ($position == 'top')
                top: 50px;
            @endif
        }

        body>.fi-layout>aside {
            @if ($fixed || $position == 'top')
                @if ($position == 'top')
                    padding-top: 50px;
                @else
                    padding-bottom: 50px;
                @endif
            @endif
        }

        #impersonate-banner {
            @if ($fixed || $position == 'top')
                position: fixed;

                @if ($position == 'top')
                    top: 0;
                    z-index: 39;
                @else
                    @if ($position == 'bottom')
                        z-index: 9;
                        bottom: 0;
                    @endif
                @endif
            @else
                position: relative;
                z-index: 18;
            @endif
            height: 50px;
            width: 100%;
            display: flex;
            column-gap: 20px;
            justify-content: center;
            align-items: center;

            @if ($style == 'dark')
                background-color: #1f2937;
                color: #f3f4f6;
                border-bottom: 1px solid #374151;
            @else
                background-color: #f3f4f6;
                color: #1f2937;
            @endif
        }

        #impersonate-banner a {
            display: block;
            padding: 4px 20px;
            background-color: #d1d5db;
            color: #000;
            border-radius: 5px;
        }

        #impersonate-banner a:hover {
            @if ($style == 'dark')
                background-color: #f3f4f6;
            @else
                background-color: #9ca3af;
            @endif
        }

        @media print {

            aside,
            body {
                margin-top: 0;
            }

            #impersonate-banner {
                display: none;
            }
        }
    </style>

    <div id="impersonate-banner">
        <div>
            {{ __('Impersonating user') }} <strong>{{ $display }}</strong>
        </div>

        <a href="{{ route('filament-impersonate.leave') }}">{{ __('Leave') }}</a>
    </div>
@endIf
