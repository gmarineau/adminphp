<?php

namespace Gmarineau\AdminPhp\Tests\Fixtures;

use Gmarineau\AdminPhp\Concerns\HasBlocks;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasBlocks;
    use HasTranslations;
    use HasUlids;

    /**
     * @var array<int, string>
     */
    public array $translatable = ['title', 'lead'];
}
