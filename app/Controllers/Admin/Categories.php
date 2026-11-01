<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Categories extends BaseController
{
    public function index()
    {
        $db   = db_connect();
        $rows = $db->query('SELECT c.*, (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id) AS product_count FROM categories c ORDER BY c.sort_order, c.name')->getResultArray();

        $tree = [];
        foreach ($rows as $r) {
            if (! $r['parent_id']) {
                $tree[$r['id']] = $r + ['children' => []];
            }
        }
        foreach ($rows as $r) {
            if ($r['parent_id'] && isset($tree[$r['parent_id']])) {
                $tree[$r['parent_id']]['children'][] = $r;
            }
        }

        return view('admin/categories/index', $this->base('Categories', 'categories') + ['tree' => $tree]);
    }

    public function create()
    {
        return view('admin/categories/form', $this->base('Add Category', 'add-category') + $this->formData(null));
    }

    public function edit(int $id)
    {
        $cat = db_connect()->table('categories')->where('id', $id)->get()->getRowArray();
        if (! $cat) {
            return redirect()->to(site_url('admin/categories'))->with('error', 'Category not found.');
        }

        return view('admin/categories/form', $this->base('Edit Category', 'categories') + $this->formData($cat));
    }

    public function store()
    {
        return $this->save(null);
    }

    public function update(int $id)
    {
        return $this->save($id);
    }

    public function delete(int $id)
    {
        $db = db_connect();
        if ($db->table('products')->where('category_id', $id)->countAllResults() > 0 || $db->table('categories')->where('parent_id', $id)->countAllResults() > 0) {
            return redirect()->back()->with('error', 'Move or delete its products and sub-categories first.');
        }
        $db->table('categories')->where('id', $id)->delete();

        return redirect()->to(site_url('admin/categories'))->with('success', 'Category deleted.');
    }

    private function save(?int $id)
    {
        if (! $this->validate(['name' => 'required|min_length[2]|max_length[191]', 'parent_id' => 'permit_empty|is_natural_no_zero', 'sort_order' => 'permit_empty|is_natural'])) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $db     = db_connect();
        $post   = $this->request->getPost();
        $parent = (int) ($post['parent_id'] ?? 0) ?: null;
        if ($parent && ($parent === $id || $db->table('categories')->where('id', $parent)->where('parent_id IS NULL', null, false)->countAllResults() === 0)) {
            return redirect()->back()->withInput()->with('error', 'Choose a top-level category as the parent.');
        }
        if ($id && $parent && $db->table('categories')->where('parent_id', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', 'This category has sub-categories, so it must stay top-level.');
        }

        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $post['name']), '-')) ?: 'category';
        $base = $slug;
        for ($n = 2; $db->table('categories')->where('slug', $slug)->where('id !=', (int) $id)->countAllResults() > 0; $n++) {
            $slug = $base . '-' . $n;
        }

        $data = [
            'parent_id'   => $parent,
            'name'        => trim($post['name']),
            'description' => trim((string) ($post['description'] ?? '')) ?: null,
            'sort_order'  => (int) ($post['sort_order'] ?? 0),
            'is_active'   => isset($post['is_active']) ? 1 : 0,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];
        if ($id) {
            $existing = $db->table('categories')->where('id', $id)->get()->getRowArray();
            if ($existing && $existing['name'] !== $data['name']) {
                $data['slug'] = $slug; // keep existing URLs stable unless it was renamed
            }
            $db->table('categories')->where('id', $id)->update($data);
        } else {
            $db->table('categories')->insert($data + ['slug' => $slug, 'show_on_home' => 0, 'created_at' => date('Y-m-d H:i:s')]);
        }

        return redirect()->to(site_url('admin/categories'))->with('success', 'Category saved.');
    }

    private function formData(?array $cat): array
    {
        return [
            'category' => $cat,
            'parents'  => db_connect()->table('categories')->where('parent_id IS NULL', null, false)->orderBy('sort_order')->orderBy('name')->get()->getResultArray(),
        ];
    }

    private function base(string $title, string $nav): array
    {
        return [
            'title'      => $title,
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => $nav,
        ];
    }
}
