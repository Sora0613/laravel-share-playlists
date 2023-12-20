<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistsController extends Controller
{
    public function home()
    {
        return view('playlists.home');
    }

    public function index()
    {
        $playlists = Playlist::where('user_id', Auth::user()->id)->get();

        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        $playlists = Playlist::where('user_id', Auth::user()->id)->get();

        if (count($playlists) > 0) {
            return view('playlists.create', compact('playlists'));
        }

        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'playlist_name' => 'required|max:255',
            'playlist_description' => 'required|max:255',
        ]);

        Playlist::create([
            'playlist_name' => $request->input('playlist_name'),
            'playlist_description' => $request->input('playlist_description'),
            'user_id' => Auth::user()->id,
            'is_private' => $request->input('is_private') ? true : false,
        ]);

        $playlists = Playlist::where('user_id', Auth::user()->id)->get();

        return view('playlists.create', compact('playlists'));
    }

    public function show($id)
    {
        /* プレイリストに登録されている曲を取得。
        is_privateがonなら、自分のプレイリスト以外は表示しない。
        playlistがなければ存在しない旨を返す。*/

        $playlist = Playlist::find($id);

        if($playlist === null) {
            $message = 'このプレイリストは存在しません。';
            return view('playlists.show', compact('message'));
        }

        //曲を取得
        $songs = Song::where('playlist_id', $id)->get();

        if ($playlist->is_private) {

            if(isset(Auth::user()->id) && $playlist->user_id === Auth::user()->id) {
                $user = User::find($playlist->user_id);
                return view('playlists.show', compact('playlist', 'user', 'songs'));
            }

            $message = 'このプレイリストは非公開です。';
            return view('playlists.show', compact('message'));
        }

        $user = User::find($playlist->user_id);
        return view('playlists.show', compact('playlist', 'user', 'songs'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
