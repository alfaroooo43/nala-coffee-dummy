<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_accessible(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_session_expires_after_five_minutes_of_inactivity(): void
    {
        $admin = User::create([
            'name' => 'Test Admin',
            'email' => 'timeout@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->withSession(['admin.last_activity' => now()->subSeconds(301)->timestamp])
            ->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    public function test_shopee_click_records_and_redirects(): void
    {
        $category = Category::create([
            'name' => 'Arabica',
            'slug' => 'arabica',
            'status' => 'active',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Arabica Ijen',
            'slug' => 'arabica-ijen',
            'description' => 'Dummy coffee',
            'image' => 'images/products/arabica-ijen.png',
            'body_score' => 80,
            'acidity_score' => 78,
            'fruity_score' => 83,
            'weight_options' => '250g,500g',
            'shopee_url' => 'https://shopee.co.id/example',
            'status' => 'active',
        ]);

        $response = $this->get('/products/'.$product->slug.'/shopee');

        $response->assertRedirect('https://shopee.co.id/example');
        $this->assertDatabaseHas('marketplace_clicks', [
            'product_id' => $product->id,
            'marketplace' => 'shopee',
            'source' => 'product_page',
        ]);
    }

    public function test_gallery_delete_accepts_string_route_id_and_removes_record(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin', 'status' => 'active']);
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image' => 'images/gallery/gallery-1.png',
            'category' => 'Lifestyle',
            'sort_order' => 1,
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->delete('/admin/gallery/'.$gallery->id);

        $response->assertRedirect('/admin/gallery');
        $response->assertSessionHas('success', 'Gallery berhasil dihapus.');
        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
    }

    public function test_missing_gallery_delete_returns_flash_error(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin', 'status' => 'active']);

        $response = $this->actingAs($admin)->delete('/admin/gallery/999999');

        $response->assertRedirect('/admin/gallery');
        $response->assertSessionHas('error', 'Data tidak ditemukan.');
    }

    public function test_published_article_is_created_and_rendered_on_landing_page(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin', 'status' => 'active']);

        $createResponse = $this->actingAs($admin)->post('/admin/articles', [
            'title' => 'Cerita Baru dari Ijen',
            'slug' => 'cerita-baru-dari-ijen',
            'excerpt' => 'Cerita kopi dari lereng Ijen.',
            'content' => 'Konten artikel untuk pengujian.',
            'category' => 'Cerita Nala',
            'status' => 'published',
        ]);

        $createResponse->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', [
            'slug' => 'cerita-baru-dari-ijen',
            'status' => 'published',
        ]);

        $this->get('/')->assertSee('Cerita Baru dari Ijen')->assertSee('Cerita kopi dari lereng Ijen.');
    }

    public function test_article_can_be_updated_and_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin', 'status' => 'active']);
        $article = Article::create([
            'title' => 'Artikel Lama',
            'slug' => 'artikel-lama',
            'content' => 'Konten lama',
            'status' => 'draft',
        ]);

        $updateResponse = $this->actingAs($admin)->put('/admin/articles/'.$article->id, [
            'title' => 'Artikel Baru',
            'slug' => 'artikel-baru',
            'excerpt' => 'Ringkasan baru',
            'content' => 'Konten baru',
            'category' => 'Berita',
            'status' => 'published',
        ]);
        $updateResponse->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', ['id' => $article->id, 'title' => 'Artikel Baru', 'status' => 'published']);

        $deleteResponse = $this->actingAs($admin)->delete('/admin/articles/'.$article->id);
        $deleteResponse->assertRedirect('/admin/articles');
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
