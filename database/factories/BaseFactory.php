<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

abstract class BaseFactory extends Factory
{
    public function modelName(): string
    {
        $resolver = fn(self $factory) => "Modules\\" .
            Str::plural(Str::replaceLast('Factory', '', class_basename($factory))) . "\\" .
            Str::replaceLast('Factory', '', class_basename($factory));

        return $this->model ?: $resolver($this);
    }
}
