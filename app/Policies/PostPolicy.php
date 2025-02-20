<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
   

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        // যাদের role 'admin' তারা সব পোস্ট দেখতে পারবে
        if (in_array($user->role->name ,['Admin','Editor'])) {
            return true;
        }

        // Editor বা User শুধুমাত্র নিজের পোস্ট দেখতে পারবে
        return $user->id === $post->user_id;
    }


   
    
}
