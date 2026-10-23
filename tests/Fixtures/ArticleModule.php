<?php

namespace Gmarineau\AdminPhp\Tests\Fixtures;

use Gmarineau\AdminPhp\Fields\Blocks;
use Gmarineau\AdminPhp\Fields\Text;
use Gmarineau\AdminPhp\Modules\Module;

class ArticleModule extends Module
{
    protected string $model = Article::class;

    public function form(): array
    {
        return [
            Text::make('title')->label('Titre')->translatable()->required(),
            Text::make('lead')->label('Chapeau')->translatable()->multiline(),
            Blocks::make('content')->label('Contenu')->allow([TextBlock::class, QuoteBlock::class]),
        ];
    }
}
