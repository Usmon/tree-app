<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tree
 * @package App\Models
 *
 * @property integer $parent_id
 * @property integer $position
 * @property string $text
 * @property-read int $child_count
 */
class Tree extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'position',
        'text'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'parent_id' =>  'integer',
        'position' => 'integer',
        'text' => 'string'
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
                    ->orderBy('position', 'asc')
                    ->with('children');
    }

    /**
     * @return int
     */
    public function getChildCountAttribute(): int
    {
        return $this->children()
                    ->count();
    }
}
