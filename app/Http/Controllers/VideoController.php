<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('cms.table.tablevideo', compact('videos'));
    }

    public function create()
    {
        $videos = Video::latest()->get()->unique('path');
        return view('cms.backend.addvideo', compact('videos'));
    }

    private function youtubeEmbedUrl($url)
{
    // Shortlink youtu.be/xxxxx
    if (strpos($url, 'youtu.be/') !== false) {
        $parts = explode('/', $url);
        $lastPart = end($parts);
        $videoId = explode('?', $lastPart)[0]; // Hilangkan ?list= dll
        return 'https://www.youtube.com/embed/' . $videoId;
    }

    // Format watch?v=xxxxx
    if (strpos($url, 'watch?v=') !== false) {
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        if (isset($params['v'])) {
            return 'https://www.youtube.com/embed/' . $params['v'];
        }
    }

    return $url; // fallback: biarkan seperti aslinya
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:local,youtube',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20000',
            'youtube_link' => 'nullable|url',
        ]);

        if ($request->type == 'local' && $request->hasFile('video')) {
            $file = $request->file('video');
            $path = $file->store('videos', 'public');
        } elseif ($request->type == 'youtube' && $request->filled('youtube_link')) {
            $path = $this->youtubeEmbedUrl($request->youtube_link); // 🔧 Convert di sini
        } else {
            return back()->with('error', 'Video file atau link tidak valid.');
        }

        Video::create([
            'title' => $request->title,
            'type' => $request->type,
            'path' => $path,
        ]);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');
    }
}
