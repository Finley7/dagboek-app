<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

/**
 *
 */
class DiaryArticle extends Model
{
    use HasFactory;
    use HasRichText;

    /**
     * @var array|string[]
     */
    protected array $richTextFields = [
        'body'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'date', 'diary_id', 'body'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
}
