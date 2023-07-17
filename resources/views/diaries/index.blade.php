<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Diaries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("This is your diaries page. You can create new diaries or edit the articles inside them") }}
                    <br>
                    <a class="btn bg-green-500" href="{{ route('diary.create') }}">{{ __('Create new diary') }}</a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @if (\Session::has('success'))
                <div
                    class="p-3 bg-green-500 rounded tracking-tight text-white mb-3">{{ \Session::get('success') }}</div>
            @endif
            @foreach ($diaries as $diary)
                <div class="px-1 mb-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="text-gray-900 flex justify-between items-center p-4">
                            <h1 class="text-xl font-bold">{{ $diary->title }} {{ $diary->created_at }}</h1>
                            <small class="italic text-sm">{{ __('Current articles') }}
                                : {{ count($diary->articles) }}
                            </small>
                        </div>
                        <div class="flex space-x-2 mt-2 px-4 pb-4">
                            <a class="btn bg-green-500"
                               href="{{ route('diary.article.create', ['diaryId' => $diary->id]) }}">{{ __('New article') }}</a>
                            <a class="btn bg-orange-500"
                               href="{{ route('diary.edit', ['id' => $diary->id]) }}">{{ __('Edit') }}</a>
                            <a onclick="return confirm('{{ __('Are you sure you want to delete this diary and all of its articles?') }}')"
                               class="btn bg-red-500"
                               href="{{ route('diary.delete', ['id' => $diary->id]) }}">{{ __('Delete') }}</a>
                        </div>

                        <ul class="bg-gray-50">
                            @foreach($diary->articles as $article)
                                <li class="p-4 flex justify-between">
                                    {{ $article->date }} {{ $article->title }}
                                    <div>
                                        <a class="btn bg-orange-500"
                                           href="{{ route('diary.article.edit', ['diaryArticleId' => $article->id]) }}">{{ __('Edit') }}</a>
                                        <a class="btn bg-red-500"
                                           href="{{ route('diary.article.delete', ['diaryArticleId' => $article->id]) }}">{{ __('Delete') }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
