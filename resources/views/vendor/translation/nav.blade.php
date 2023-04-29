<nav class="header">
    <h1 class="text-lg px-6">@lang('backend.translation-panel')</h1>
    <ul class="flex-grow justify-end pr-2">
        <li>
            <a href="{{ route('languages.index') }}" class="{{ set_active('') }}{{ set_active('/create') }}">
                @include('translation::icons.globe')
                {{ __('backend.languages') }}
            </a>
        </li>
        <li>
            <a href="{{ route('languages.translations.index', config('app.locale')) }}" class="{{ set_active('*/translations') }}">
                @include('translation::icons.translate')
                {{ __('backend.translation') }}
            </a>
        </li>
    </ul>
</nav>
