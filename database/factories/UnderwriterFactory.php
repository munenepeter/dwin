<?php

namespace Database\Factories;

use App\Models\Underwriter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Underwriter>
 */
class UnderwriterFactory extends Factory {

    protected $model = Underwriter::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'name' => $this->faker->randomElement(['monarch', 'kenya orient', 'uap', 'jubilee', 'cic','madison'])
        ];
    }
}
