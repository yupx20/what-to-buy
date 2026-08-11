<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonyRequest;
use App\Models\Testimony;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /**
     * Display the community reviews page.
     */
    public function index()
    {
        $testimonies = Testimony::approved()
            ->latestFirst()
            ->paginate(12);

        $averageRating = Testimony::approved()->avg('rating') ?? 0;
        $totalReviews = Testimony::approved()->count();

        return view('storefront.community', compact('testimonies', 'averageRating', 'totalReviews'));
    }

    /**
     * Store a new testimony.
     */
    public function store(StoreTestimonyRequest $request)
    {
        $data = $request->validated();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('testimonies', 'public');
        }

        Testimony::create([
            'user_id' => auth()->id(),
            'customer_name' => auth()->user()->name,
            'rating' => $data['rating'],
            'review_text' => $data['review_text'],
            'photo_path' => $photoPath,
            'is_approved' => false, // Requires admin approval
        ]);

        return back()->with('success', 'Thank you for your review! It will be visible after approval.');
    }
}
