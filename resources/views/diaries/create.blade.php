<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-3 text-gray-900">
                    <h1></h1>
                    <a class="btn bg-gray-500" href="{{ route('diary.index') }}">{{ __('Diary summary') }}</a>
                </div>
                <div class="p-6">
                    <h1 class="pb-3">{{ __('Create diary') }}</h1>
                    @if (\Session::has('success'))
                        <div
                            class="p-3 bg-green-500 rounded tracking-tight text-white">{{ \Session::get('success') }}</div>
                    @endif
                    <form method="post" action="{{ route('diary.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                          :value="old('title')" required autofocus autocomplete="title"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>
                        <button class="btn bg-green-500 mt-3">{{ __('Create diary') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
