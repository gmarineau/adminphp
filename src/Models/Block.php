<?php

namespace Gmarineau\AdminPhp\Models;

use Gmarineau\AdminPhp\AdminPhp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $blockable_type
 * @property string $blockable_id
 * @property string $editor_name
 * @property string|null $parent_id
 * @property string|null $child_key
 * @property string $type
 * @property int $schema_version
 * @property int $position
 * @property array<string, mixed> $content
 */
class Block extends Model
{
    use HasUlids;

    protected $fillable = [
        'editor_name',
        'parent_id',
        'child_key',
        'type',
        'schema_version',
        'position',
        'content',
    ];

    public function getTable(): string
    {
        return app(AdminPhp::class)->table('blocks');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'schema_version' => 'integer',
            'position' => 'integer',
            'content' => 'array',
        ];
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo<Block, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany<Block, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('position');
    }
}
