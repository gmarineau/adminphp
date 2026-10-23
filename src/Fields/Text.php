<?php

namespace Gmarineau\AdminPhp\Fields;

class Text extends Field
{
    protected bool $isMultiline = false;

    protected int $maxLength = 255;

    public function type(): string
    {
        return 'text';
    }

    public function multiline(bool $isMultiline = true): static
    {
        $this->isMultiline = $isMultiline;

        if ($isMultiline && $this->maxLength === 255) {
            $this->maxLength = 5000;
        }

        return $this;
    }

    public function maxLength(int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    protected function valueRules(): array
    {
        return ['string', "max:{$this->maxLength}", ...$this->rules];
    }

    protected function schemaAttributes(): array
    {
        return [
            'multiline' => $this->isMultiline,
            'maxLength' => $this->maxLength,
        ];
    }
}
