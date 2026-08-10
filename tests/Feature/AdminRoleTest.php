<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a regular user cannot access the admin dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/dashboard')
        ->assertRedirect('/dashboard');
});

test('an admin can access the admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee('Admin Dashboard');
});

test('a regular user dashboard does not show KPIs or charts', function () {
    $user = User::factory()->create();
    Product::create([
        'name' => 'Product A',
        'sku' => 'PROD-001',
        'price' => 10.00,
        'quantity' => 4,
    ]);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertDontSee('Total Products')
        ->assertDontSee('Total Units')
        ->assertDontSee('Inventory Value')
        ->assertDontSee('Low Stock Items')
        ->assertDontSee('Stock Levels by Product')
        ->assertDontSee('Inventory Value by Product');
});

test('the admin dashboard shows KPIs and charts', function () {
    $admin = User::factory()->admin()->create();
    Product::create([
        'name' => 'Product A',
        'sku' => 'PROD-001',
        'price' => 10.00,
        'quantity' => 4,
    ]);

    $this->actingAs($admin)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertSee('Total Products')
        ->assertSee('Total Units')
        ->assertSee('Inventory Value')
        ->assertSee('Low Stock Items')
        ->assertSee('Stock Levels by Product')
        ->assertSee('Inventory Value by Product');
});

test('a regular user is redirected to their dashboard after login', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/dashboard');
});

test('an admin is redirected to the admin dashboard after login', function () {
    $admin = User::factory()->admin()->create();

    $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password',
    ])->assertRedirect('/admin/dashboard');
});

test('a new user is created with the default user type', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect('/');

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->type)->toBe('user')
        ->and($user->isAdmin())->toBeFalse();
});
