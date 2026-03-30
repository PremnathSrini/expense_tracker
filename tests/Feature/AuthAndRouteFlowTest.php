<?php

namespace Tests\Feature;

use App\Models\Bill;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthAndRouteFlowTest extends TestCase
{
    use RefreshDatabase;

    private function seedRoles(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'user', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function test_unauthenticated_user_route_access_redirects_to_login_form(): void
    {
        $response = $this->get(route('user.transactions'));

        $response->assertRedirect(route('user.loginForm'));
    }

    public function test_admin_access_to_user_route_redirects_to_login_form(): void
    {
        $this->seedRoles();

        $admin = User::factory()->create([
            'role_id' => 1,
        ]);

        $response = $this->actingAs($admin)->get(route('user.transactions'));

        $response->assertRedirect(route('user.loginForm'));
    }

    public function test_email_verification_redirects_to_user_login_form_when_already_verified(): void
    {
        $this->seedRoles();

        $user = User::factory()->create([
            'role_id' => 2,
            'email_verified_at' => now(),
        ]);

        $hash = sha1($user->email);

        $response = $this->get(route('custom.verification', [
            'id' => $user->id,
            'hash' => $hash,
        ]));

        $response->assertRedirect(route('user.loginForm'));
    }

    public function test_bill_destroy_route_deletes_bill_with_delete_method(): void
    {
        $this->seedRoles();

        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $bill = Bill::create([
            'user_id' => $user->id,
            'name' => 'Internet',
            'due_date' => now()->toDateString(),
            'amount' => 1299,
            'is_paid' => false,
            'is_recurring' => true,
            'recurring_interval' => 1,
        ]);

        $response = $this->actingAs($user)->delete(route('user.bill.destroy', [
            'bilId' => base64_encode((string) $bill->id),
        ]));

        $response->assertRedirect();
        $this->assertDatabaseMissing('bills', ['id' => $bill->id]);
    }

    public function test_transaction_store_accepts_income_and_rejects_invalid_type(): void
    {
        $this->seedRoles();

        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $category = Category::create([
            'name' => 'Food',
        ]);

        $validResponse = $this->actingAs($user)->post(route('user.transaction.store'), [
            'description' => 'Salary credit',
            'amount' => 12000,
            'date' => now()->toDateString(),
            'type' => 'income',
            'category' => $category->id,
        ]);

        $validResponse->assertRedirect(route('user.transactions'));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'income',
        ]);

        $invalidResponse = $this->actingAs($user)->post(route('user.transaction.store'), [
            'description' => 'Broken type payload',
            'amount' => 500,
            'date' => now()->toDateString(),
            'type' => '1',
            'category' => $category->id,
        ]);

        $invalidResponse->assertSessionHasErrors('type');
    }

    public function test_transaction_destroy_without_attachment_does_not_error(): void
    {
        $this->seedRoles();

        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $category = Category::create([
            'name' => 'Transport',
        ]);

        $transaction = Transaction::create([
            'description' => 'Bus pass',
            'amount' => 120,
            'date' => now()->toDateString(),
            'type' => 'expense',
            'category_id' => $category->id,
            'attachment_id' => null,
            'user_id' => $user->id,
            'other_text' => null,
        ]);

        $response = $this->actingAs($user)->delete(route('user.transaction.delete', [
            'transactionId' => base64_encode((string) $transaction->id),
        ]));

        $response->assertRedirect(route('user.transactions'));
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}
