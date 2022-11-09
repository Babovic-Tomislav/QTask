<style>
    table, th, td {
        border:1px solid black;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create book') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 form-group">
                    {{ Form::open(['url' => route('book.create'), 'method' => 'POST']) }}
{{--                    {{ Form::token() }}--}}
                    <div class="md:w-1/3">
                        {{ Form::Label('title', 'Title:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::text('title') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('release_date', 'Release date:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::Date('release_date') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('description', 'Description:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::text('description') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('isbn', 'ISBN:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::text('isbn') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('format', 'Format:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::text('format') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('number_of_pages', 'Number of pages:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::number('number_of_pages') }}
                    </div>
                    <div class="md:w-1/3">
                        {{ Form::Label('author', 'Author:') }}
                    </div>
                    <div class="md:w-2/3">
                        {{ Form::select('author', $authorSelectOptions) }}
                    </div>
                    {{ Form::submit('Click Me!') }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>