<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeatureListResource extends JsonResource
{
    // Todo FeatureListResource (DTO) is important, you do not want to expose confidential data


    // Show.tsx does not like the wrap
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //dd($this);

        // Todo what the hell is $this here?
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'upvote_count' => $this->upvote_count ?: 0,
            'user_has_upvoted' => (boolean)$this->user_has_upvoted,
            'user_has_downvoted' => (boolean)$this->user_has_downvoted,
        ];
    }
}
