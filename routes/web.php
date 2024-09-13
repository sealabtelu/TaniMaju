<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str class
use Illuminate\Support\Facades\Log; // Import Log class
use Illuminate\Http\Request;
use App\Models\User;
use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Models\Post;


Route::get('/', function () {
    return redirect('/home'); 
});


Route::post('/posts/{post:slug}/comment', function (Request $request, Post $post) {
    // Validate request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'comment' => 'required',
    ]);

    // Find or create the user
    $user = User::firstOrCreate(
        ['email' => $validated['email']],
        ['name' => $validated['name'], 'password' => Hash::make(Str::random(16))]
    );

    Log::info('User created or found:', ['user_id' => $user->id]);

    // Log post retrieval
    Log::info('Post retrieved:', ['post_id' => $post->id]);

    // Insert the comment directly into the comments table
    try {
        $inserted = DB::table('fblog_comments')->insert([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment' => $validated['comment'],
            'approved' => true,
            'approved_at' => now()->format('Y-m-d H:i:s'),
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ]);

        Log::info('Comment inserted:', ['inserted' => $inserted]);
    } catch (\Exception $e) {
        Log::error('Comment insertion failed:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Failed to post comment.');
    }

    return redirect()->back()->with('success', 'Your comment has been posted!');
})->name('filamentblog.comment.store');
