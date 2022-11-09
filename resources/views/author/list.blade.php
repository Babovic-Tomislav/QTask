<style>
    table, th, td {
        border:1px solid black;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!empty($data))
                        <table style="width:100%;text-align: center">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Place of birth</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                            @foreach ($data['items'] as $author)
                                <tr>
                                    <td>{{ $author['first_name'] }}</td>
                                    <td>{{ $author['last_name'] }}</td>
                                    <td>{{ $author['birthday'] }}</td>
                                    <td>{{ $author['gender'] }}</td>
                                    <td>{{ $author['place_of_birth'] }}</td>
                                    <td>
                                        <a href="{{ route('author.details', ['author' => $author['id']]) }}" style="color: blue">View</a>
                                    </td>
                                    <td style="color: red;">
                                        {{ Form::open(['url' => route('author.delete', ['author' => $author['id']]), 'method' => 'DELETE']) }}
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
    </div>
</x-app-layout>