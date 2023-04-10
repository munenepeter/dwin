<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{


    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pl = $this->faker->numberBetween(1000, 100000);
        $ep = $this->faker->numberBetween(1000, 100000);
        $bp = $this->faker->numberBetween(1000, 100000);
        $aed = $this->faker->dateTimeThisMonth();

        return [
            'full_names' => $this->faker->name(),
            'policy_number' => $this->faker->randomNumber(7, true),
            'underwriter_id' => $this->faker->numberBetween(1, 6),
            'insurance_id' => $this->faker->numberBetween(1, 2),
            'risk_id' => $this->faker->numerify('K'.$this->faker->randomElement(['a','b','c','d']).$this->faker->randomElement(['a','d','o','p']).'-###'.$this->faker->randomElement(['m','n','s'])),
            'sum_insured' => $this->faker->numberBetween(1000, 1000000),
            'political_risk' => $pl,
            'excess_protector' => $ep,
            'basic_premium' => $bp,
            'annual_total_premium' => $pl + $ep + $bp,
            'annual_expiry_date' => $aed,
            'annual_renewal_date' => $aed->modify("+1 year")   
        ];
    }
}
