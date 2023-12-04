<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Playlist Create</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            margin: 50px auto;
            max-width: 800px; /* 画面幅の最大値を指定 */
        }

        h1 {
            font-size: 2em;
            color: #333;
        }

        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px; /* 角を丸くする */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* 幅を100%にする */
            box-sizing: border-box; /* paddingやborderが幅に含まれるようにする */
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input {
            width: calc(100% - 20px); /* 幅からpadding分を引く */
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button {
            width: 100%; /* 幅を100%にする */
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1e6cd1;
        }

        .result-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px; /* 角を丸くする */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* 幅を100%にする */
            box-sizing: border-box; /* paddingやborderが幅に含まれるようにする */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        img {
            max-width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1> Songs</h1>

    <form id="song-form" action="{{ route('spotify.playlist.create') }}" method="GET">
        @csrf
        <label for="playlist-url">Playlist URL:</label>
        <input type="url" id="playlist-url" name="playlist-url" placeholder="https://open.spotify.com/playlist/*********" required>

        <button type="submit">Create Playlist</button>
    </form>

    @isset($track_data)
        <div class="result-form">
            <table>
                <thead>
                <tr>
                    <th>Artwork</th>
                    <th>Artist</th>
                    <th>Song Title</th>
                </tr>
                </thead>
                <tbody>
                @foreach($track_data['items'] as $song)
                    <tr>
                        <td><img src="{{ $song['track']['album']['images'][0]['url'] }}" alt="song artwork" width="100" height="100"></td>
                        <td>{{ $song['track']['artists'][0]['name'] }}</td>
                        <td>{{ $song['track']['name'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endisset
</div>

</body>
</html>
