<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\StripeClient;
use Tests\TestCase;

class PurchaseListingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_purchase_a_listing(): void
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $paymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => fake()->month,
                'exp_year' => (int)now()->format('Y') + rand(1, 4),
                'cvc' => rand(100, 999)
            ]
        ]);

        $response = $this->post(route('listings.store'), [
            'name' => 'Test Name',
            'email' => $email = 'test@example.com',
            'password' => 'testpassword',
            'password_confirmation' => 'testpassword',
            'title' => $title = 'Test Title',
            'location' => 'Remote, Worldwide',
            'company' => $company = 'Test Company Name',
            'salary' => 75000,
            'contract_type' => 'full-time',
            'tags' => 'php, javascript, laravel',
            'apply_link' => $applyLink = 'https://yourcompany.com/careers',
            'content' => '<p>Test Content</p>',
            'payment_method_id' => $paymentMethod->id
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', ['email' => $email]);

        $this->assertDatabaseHas('listings', [
            'title' => $title,
            'company' => $company,
            'apply_link' => $applyLink,
        ]);
    }
}
