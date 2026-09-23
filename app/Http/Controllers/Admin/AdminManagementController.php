<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Member;
use App\Models\Partnership;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminManagementController extends Controller
{
    private const MODULES = ['gallery', 'articles', 'members', 'partnerships', 'users'];

    public function index(Request $request, string $module): View
    {
        $this->ensureModule($module);
        $query = $this->queryFor($module);
        $search = trim((string) $request->query('search'));
        if ($search !== '') {
            $columns = match ($module) {
                'gallery' => ['title', 'category', 'caption'],
                'partnerships' => ['name', 'email', 'business_name'],
                'articles' => ['title', 'slug', 'category'],
                'members', 'users' => ['name', 'email'],
                default => ['name'],
            };
            $query->where(function ($builder) use ($search, $columns): void {
                foreach ($columns as $index => $column) {
                    if ($index === 0) {
                        $builder->where($column, 'like', "%{$search}%");
                    } else {
                        $builder->orWhere($column, 'like', "%{$search}%");
                    }
                }
            });
        }
        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.module', [
            'module' => $module,
            'title' => $this->titleFor($module),
            'items' => $items,
        ]);
    }

    public function create(string $module): View
    {
        $this->ensureModule($module);

        return view('admin.module-form', ['module' => $module, 'title' => $this->titleFor($module), 'item' => null]);
    }

    public function store(Request $request, string $module): RedirectResponse
    {
        $this->ensureModule($module);
        $data = $this->validated($request, $module);
        $model = $this->modelFor($module);
        $model::create($data);

        return redirect()->route("admin.{$module}.index")->with('success', "{$this->titleFor($module)} berhasil dibuat.");
    }

    public function edit(string $id, string $module): View
    {
        $this->ensureModule($module);
        $id = $this->routeId($id);

        return view('admin.module-form', [
            'module' => $module,
            'title' => $this->titleFor($module),
            'item' => $this->modelFor($module)::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id, string $module): RedirectResponse
    {
        $this->ensureModule($module);
        $id = $this->routeId($id);
        $item = $this->modelFor($module)::findOrFail($id);
        $item->update($this->validated($request, $module, $item));

        return redirect()->route("admin.{$module}.index")->with('success', "{$this->titleFor($module)} berhasil diperbarui.");
    }

    public function destroy(string $id, string $module): RedirectResponse
    {
        $this->ensureModule($module);
        $validatedId = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($validatedId === false) {
            return redirect()->route("admin.{$module}.index")->with('error', 'ID data tidak valid.');
        }
        if ($module === 'users' && auth()->id() === $validatedId) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $item = $this->modelFor($module)::find($validatedId);
        if ($item === null) {
            return redirect()->route("admin.{$module}.index")->with('error', 'Data tidak ditemukan.');
        }
        $file = $module === 'gallery' ? $item->image : ($module === 'articles' ? $item->thumbnail : null);
        if ($file && Str::startsWith($file, 'cms/')) {
            Storage::disk('public')->delete($file);
        }
        $item->delete();

        return redirect()->route("admin.{$module}.index")->with('success', "{$this->titleFor($module)} berhasil dihapus.");
    }

    public function updateMemberStatus(Request $request, string $id): RedirectResponse
    {
        $id = $this->routeId($id);
        $data = $request->validate(['status' => ['required', 'in:active,inactive,blocked']]);
        Member::findOrFail($id)->update($data);

        return back()->with('success', 'Status member berhasil diperbarui.');
    }

    public function settings(): View
    {
        return view('admin.settings', ['settings' => Setting::query()->pluck('value', 'key')]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'website_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'shopee_url' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'google_maps' => ['nullable', 'url', 'max:1000'],
        ]);
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    private function validated(Request $request, string $module, ?Model $item = null): array
    {
        return match ($module) {
            'gallery' => $this->galleryData($request),
            'articles' => $this->articleData($request, $item),
            'partnerships' => $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'business_name' => ['nullable', 'string', 'max:255'],
                'business_type' => ['nullable', 'string', 'max:255'],
                'city' => ['nullable', 'string', 'max:255'],
                'phone' => ['nullable', 'string', 'max:30'],
                'email' => ['nullable', 'email', 'max:255'],
                'message' => ['nullable', 'string'],
                'status' => ['required', 'in:new,contacted,processing,approved,rejected'],
            ]),
            'users' => $this->userData($request, $item),
            default => throw new \InvalidArgumentException('Module tidak mendukung operasi ini.'),
        };
    }

    private function galleryData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'category' => ['nullable', 'in:Kebun,Petani,Proses,Produk,Packaging,Lifestyle'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cms/gallery', 'public');
        }

        return $data;
    }

    private function articleData(Request $request, ?Model $item = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($item?->getKey())],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'category' => ['nullable', 'in:Cerita Nala,Cerita Petani,Edukasi Kopi,Berita,Tips Kopi'],
            'status' => ['required', 'in:draft,published,archived'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['author_id'] = auth()->id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('cms/articles', 'public');
        }

        return $data;
    }

    private function userData(Request $request, ?Model $item): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'.($item ? ",{$item->getKey()}" : '')],
            'role' => ['required', 'in:super_admin,content_admin,marketing'],
            'status' => ['required', 'in:active,inactive'],
            'password' => [$item ? 'nullable' : 'required', 'string', 'min:8'],
        ];
        $data = $request->validate($rules);
        if ($data['password'] ?? null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    private function queryFor(string $module)
    {
        return match ($module) {
            'gallery' => Gallery::query(),
            'articles' => Article::query(),
            'members' => Member::query(),
            'partnerships' => Partnership::query(),
            'users' => User::query(),
            default => throw new \InvalidArgumentException('Module tidak ditemukan.'),
        };
    }

    private function modelFor(string $module): string
    {
        return match ($module) {
            'gallery' => Gallery::class,
            'articles' => Article::class,
            'members' => Member::class,
            'partnerships' => Partnership::class,
            'users' => User::class,
            default => throw new \InvalidArgumentException('Module tidak ditemukan.'),
        };
    }

    private function ensureModule(string $module): void
    {
        abort_unless(in_array($module, self::MODULES, true), 404);
        if ($module === 'users' && auth()->user()?->role !== 'super_admin') {
            abort(403);
        }
    }

    private function routeId(string $id): int
    {
        $validatedId = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        abort_if($validatedId === false, 404, 'Data tidak ditemukan.');

        return $validatedId;
    }

    private function titleFor(string $module): string
    {
        return match ($module) {
            'gallery' => 'Gallery',
            'articles' => 'Artikel',
            'members' => 'Member',
            'partnerships' => 'Kemitraan',
            'users' => 'Admin / User',
            default => ucfirst($module),
        };
    }
}
