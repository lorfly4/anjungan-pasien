<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(5);
        return view('cms.table.tablevideo', compact('videos'));
    }

    public function create()
    {
        $videos = Video::all();
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



    public function editvideo(Video $video, $id)
    {
        $videos = Video::all();
        $video = Video::findOrFail($id);
        return view('cms.backend.editvideo', compact('videos', 'video'));
    }


    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:local,youtube',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20000',
            'youtube_link' => 'nullable|url',
        ]);

        $video->title = $request->title;
        $video->type = $request->type;

        // Hapus file lama jika upload baru
        if ($request->type === 'local') {
            if ($request->hasFile('video')) {
                // Hapus file lama
                if ($video->path && Storage::disk('public')->exists($video->path)) {
                    Storage::disk('public')->delete($video->path);
                }

                // Simpan file baru
                $path = $request->file('video')->store('videos', 'public');
                $video->path = $path;
            }
        } elseif ($request->type === 'youtube') {
            $video->path = $request->youtube_link;
        }

        $video->save();

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }


    public function deletevideo($id)
    {
        $video = Video::findOrFail($id);
        if ($video->path && Storage::disk('public')->exists($video->path)) {
            Storage::disk('public')->delete($video->path);
        }
        $video->delete();
        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }


    public function setActive($id)
    {
        // Set semua data jadi 0 dulu
        Video::query()->update(['status' => 0]);

        // Ubah yang diklik jadi 1
        $video = Video::findOrFail($id);
        $video->status = 1;
        $video->save();

        return back()->with('success', 'Menu berhasil diaktifkan!');
    }
}
