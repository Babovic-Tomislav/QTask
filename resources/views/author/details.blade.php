<style>
    table, th, td {
        border:1px solid black;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Author details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if(isset($author))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table style="width:100%;text-align: center">
                            <tr>
                                <td>First name</td>
                                <td>{{ $author['first_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $author['last_name'] }}</td>
                            </tr>
                            <tr>
                                <td>Birthday</td>
                                <td>{{ $author['birthday'] }}</td>
                            </tr>
                            <tr>
                                <td>Biography</td>
                                <td>{{ $author['biography'] }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $author['gender'] }}</td>
                            </tr>
                            <tr>
                                <td>Place of birth</td>
                                <td>{{ $author['place_of_birth'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if(!empty($author['books']))
                            <table style="width:100%;text-align: center">
                                <tr>
                                    <th>Title</th>
                                    <th>Release date</th>
                                    <th>Description</th>
                                    <th>Isbn</th>
                                    <th>Format</th>
                                    <th>Number of pages</th>
                                    <th>Delete</th>
                                </tr>
                                @foreach ($author['books'] as $book)
                                    <tr>
                                        <td>{{ $book['title'] }}</td>
                                        <td>{{ $book['release_date'] }}</td>
                                        <td>{{ $book['description'] }}</td>
                                        <td>{{ $book['isbn'] }}</td>
                                        <td>{{ $book['format'] }}</td>
                                        <td>{{ $book['number_of_pages'] }}</td>
                                        <td style="color: red;">
                                            {{ Form::open(['url' => route('book.delete', ['book' => $book['id']]), 'method' => 'DELETE']) }}
                                            {{ Form::submit('X') }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>