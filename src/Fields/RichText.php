<?php

namespace Gmarineau\AdminPhp\Fields;

/**
 * Rich text edited with Tiptap and stored as its JSON document.
 */
class RichText extends Field
{
    public function type(): string
    {
        return 'rich-text';
    }

    protected function valueRules(): array
    {
        return ['array', ...$this->rules];
    }
}
