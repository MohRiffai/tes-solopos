<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            // Ambil artikel yang dibuat oleh pengguna yang sedang login
        $keywords = $request->get('keywords');
        
        // Mengambil artikel berdasarkan pencarian atau menampilkan artikel milik pengguna yang sedang login
        if ($keywords) {
            $articles = Article::where('user_id', auth()->id())
                                ->where(function ($query) use ($keywords) {
                                    $query->where('title', 'like', '%' . $keywords . '%')
                                        ->orWhere('content', 'like', '%' . $keywords . '%');
                                })
                                ->with('user')  // Mengambil data user yang membuat artikel
                                ->paginate(10);
        } else {
            $articles = Article::where('user_id', auth()->id())
                                ->with('user')  // Mengambil data user yang membuat artikel
                                ->paginate(10);
        }

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ]);

        // Menyimpan artikel baru
        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'user_id' => auth()->id(),  // Menyimpan ID pengguna yang sedang login
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $article = Article::findOrFail($id);

        // Pastikan hanya pemilik artikel yang dapat mengedit artikel tersebut
        if ($article->user_id !== auth()->id()) {
            return redirect()->route('articles.index')->with('error', 'Anda tidak memiliki akses ke artikel ini.');
    }

    return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
        ]);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function search(Request $request)
    {
    // Menangkap kata kunci dari input pencarian
    $keyword = $request->input('keywords');

    // Melakukan pencarian pada judul atau konten artikel dengan kata kunci
    $home = Article::where('title', 'like', "%$keyword%")
                ->orWhere('content', 'like', "%$keyword%")
                ->orderBy('published_at', 'desc')
                ->paginate(5);

    // Mengirimkan data ke view, termasuk keyword yang dicari
    return view('frontend.search', compact('home', 'keyword'));
    }

    public function home()
    {
        $articles = Article::with('user')
                    ->orderBy('published_at', 'desc')
                    ->paginate(5); // Pastikan PAKAI paginate, bukan get()

        return view('home', compact('articles'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $article = Article::findOrFail($id);

        // Pastikan hanya pemilik artikel yang dapat menghapus artikel tersebut
        if ($article->user_id !== auth()->id()) {
            return redirect()->route('articles.index')->with('error', 'Anda tidak memiliki akses untuk menghapus artikel ini.');
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
