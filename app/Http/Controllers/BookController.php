<?php

namespace App\Http\Controllers;

use App\Contract\AuthorSelectTransformerInterface;
use App\Http\Client\QClient;
use App\Http\Requests\Book\CreateBookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function deleteAction(Request $request, QClient $client, int $bookId)
    {
        $user = Auth::user();

        try {
            $client->deleteBook($user->getTokenKey(), $bookId);
        } catch (\Throwable $exception) {
            return back()->with('error','Error deleting book!');
        }

        return back()->with('success','Book deleted successfully!');
    }

    public function createFormAction(Request $request, QClient $client, AuthorSelectTransformerInterface $authorSelectTransformer)
    {
        $user = Auth::user();

        $data = $client->getAuthors($user->getTokenKey());

        $authorOptions = $data ? $authorSelectTransformer->list($data['items']) : null;

        return view('book.create', ['authorSelectOptions' => $authorOptions]);
    }

    public function createAction(CreateBookRequest $request, QClient $client)
    {
        $user = Auth::user();

        try {
            $data = $client->createBook($user->getTokenKey(), $request->validated());

            if (!$data) {
                return back()->with('error','Error creating book!');
            }
        } catch (\Throwable $exception) {
            return back()->with('error','Error creating book!');
        }

        return redirect(route('author.details', ['author' => $request->validated()['author']['id']]))->with('success','Book created successfully!');
    }
}

