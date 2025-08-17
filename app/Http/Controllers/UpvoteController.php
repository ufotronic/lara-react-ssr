<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Upvote;
use Illuminate\Http\Request;

class UpvoteController extends Controller
{
    public function store(Request $request, Feature $feature){

        $data = $request->validate([

          //  'feature_id' => ['required', 'exists:feature,id'],
            'upvote' => ['required','boolean']
        ]);

        Upvote::updateOrCreate(
            ['feature_id' => $feature->id, 'user_id' => auth()->id()],
            ['upvote' => $data['upvote']]
        );

        return back();
    }


    public function destroy(Feature $feature){

        $feature->upvotes()->where('user_id', auth()->id())->delete();

        return back();
    }
}
