<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MarketplaceClick;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function shopeeRedirect(Request $request, string $slug): RedirectResponse
    {
        $product = Product::where('slug', $slug)->where('status', 'active')->firstOrFail();

        MarketplaceClick::create([
            'visitor_id' => session()->getId(),
            'product_id' => $product->id,
            'marketplace' => 'shopee',
            'source' => 'product_page',
            'device' => $this->device($request),
            'clicked_at' => now(),
        ]);

        abort_unless(filter_var($product->shopee_url, FILTER_VALIDATE_URL), 404);

        return redirect()->away($product->shopee_url);
    }

    public function index(): View
    {
        $products = Product::with('category')
            ->when(request('search'), fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'body_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'acidity_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'fruity_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'weight_options' => ['nullable', 'string', 'max:255'],
            'shopee_url' => ['nullable', 'url'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cms/products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'body_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'acidity_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'fruity_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'weight_options' => ['nullable', 'string', 'max:255'],
            'shopee_url' => ['nullable', 'url'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        if ($request->hasFile('image')) {
            if ($product->image && Str::startsWith($product->image, 'cms/')) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('cms/products', 'public');
        } else {
            unset($validated['image']);
        }
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function device(Request $request): string
    {
        $agent = strtolower((string) $request->userAgent());

        return str_contains($agent, 'mobile') ? 'mobile' : (str_contains($agent, 'tablet') ? 'tablet' : 'desktop');
    }
}
