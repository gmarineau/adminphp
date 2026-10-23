<?php

namespace Gmarineau\AdminPhp\Tests\Fixtures;

use Gmarineau\AdminPhp\Blocks\Block;
use Gmarineau\AdminPhp\Fields\Text;

class QuoteBlock extends Block
{
    protected string $title = 'Citation';

    protected int $version = 2;

    public function form(): array
    {
        return [
            Text::make('quote')->label('Citation')->translatable()->multiline()->required(),
            Text::make('author')->label('Auteur'),
        ];
    }
}
