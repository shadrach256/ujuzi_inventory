<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('a user can create a product with an image', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/products', [
            'name' => 'Test Product',
            'sku' => 'PROD-001',
            'price' => 19.99,
            'quantity' => 5,
            'image' => UploadedFile::fake()->create('product.jpg', 100, 'image/jpeg'),
        ])
        ->assertRedirect('/dashboard');

    $product = Product::where('sku', 'PROD-001')->first();

    expect($product)->not->toBeNull()
        ->and($product->name)->toBe('Test Product')
        ->and($product->image)->not->toBeNull()
        ->and(Storage::disk('public')->exists($product->image))->toBeTrue();
});

test('a product can be updated with a new image', function () {
    $user = User::factory()->create();
    $product = Product::create([
        'name' => 'Old Name',
        'sku' => 'PROD-002',
        'price' => 10.00,
        'quantity' => 2,
    ]);

    $this->actingAs($user)
        ->put("/products/{$product->id}", [
            'name' => 'New Name',
            'sku' => 'PROD-002',
            'price' => 15.00,
            'quantity' => 3,
            'image' => UploadedFile::fake()->create('new.jpg', 100, 'image/jpeg'),
        ])
        ->assertRedirect('/dashboard');

    $product->refresh();

    expect($product->name)->toBe('New Name')
        ->and($product->image)->not->toBeNull()
        ->and(Storage::disk('public')->exists($product->image))->toBeTrue();
});

test('a product can be deleted', function () {
    $user = User::factory()->create();
    $product = Product::create([
        'name' => 'To Delete',
        'sku' => 'PROD-003',
        'price' => 5.00,
        'quantity' => 1,
    ]);

    $this->actingAs($user)
        ->delete("/products/{$product->id}")
        ->assertRedirect('/dashboard');

    expect(Product::find($product->id))->toBeNull();
});
