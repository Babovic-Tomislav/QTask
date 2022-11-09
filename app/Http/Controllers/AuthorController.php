<?php

namespace App\Http\Controllers;

use App\Http\Client\QClient;
use App\Http\Requests\Author\AuthorListRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function listAction(AuthorListRequest $request, QClient $client)
    {
        $user = Auth::user();

        try {
            $data = $client->getAuthors($user->getTokenKey(), $request->validated());
        } catch (\Exception $exception) {
            return back()->with('error','Error fetching authors!');
        }

        return view('author.list', ['data' => $data]);
    }

    public function deleteAction(Request $request, QClient $client, int $authorId)
    {
        $user = Auth::user();

        try {
            $author = $client->getAuthor($user->getTokenKey(), $authorId);

            if (empty($author['books'])) {
                $client->deleteAuthor($user->getTokenKey(), $authorId);

                return redirect(route('author.list'))->with('success', 'Author successfully deleted.');
            }
        } catch (\Exception $exception) {
            return back()->with('error','Error deleting author!');
        }

        return redirect(route('author.list'))->with('warning', 'Author has books.');
    }

    public function detailsAction(AuthorListRequest $request, QClient $client, int $authorId)
    {
        $user = Auth::user();

        try {
            $author = $client->getAuthor($user->getTokenKey(), $authorId);
        } catch (\Exception $exception) {
            return back()->with('error','Error fetching author!');
        }
        return view('author.details', ['author' => $author]);
    }
}
