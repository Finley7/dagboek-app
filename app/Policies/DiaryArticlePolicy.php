<?php

namespace App\Policies;

use App\Models\DiaryArticle;
use App\Models\User;

/**
 *
 */
class DiaryArticlePolicy
{
    /**
     * @param User $user
     * @param DiaryArticle $diaryArticle
     * @return bool
     */
    public function crud(User $user, DiaryArticle $diaryArticle): bool
    {
        return $diaryArticle->diary->author->id == $user->id;
    }
}
