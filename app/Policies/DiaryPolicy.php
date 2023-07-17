<?php

namespace App\Policies;

use App\Models\Diary;
use App\Models\User;

class DiaryPolicy
{
    /**
     * @param User $user
     * @param Diary $diary
     * @return bool
     */
    public function crud(User $user, Diary $diary): bool
    {
        return $diary->author->id == $user->id;
    }
}
