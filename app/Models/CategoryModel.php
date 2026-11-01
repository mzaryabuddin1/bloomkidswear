<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['parent_id', 'name', 'slug', 'description', 'image', 'link_url', 'show_on_home', 'sort_order', 'is_active'];
    protected $useTimestamps = true;

    /**
     * Active categories as a tree: parents with a 'children' array.
     *
     * @return list<array<string,mixed>>
     */
    public function tree(): array
    {
        $rows = $this->where('is_active', 1)->orderBy('sort_order')->orderBy('name')->findAll();
        $tree = [];

        foreach ($rows as $row) {
            if (! $row['parent_id']) {
                $row['children'] = [];
                $tree[$row['id']] = $row;
            }
        }
        foreach ($rows as $row) {
            if ($row['parent_id'] && isset($tree[$row['parent_id']])) {
                $tree[$row['parent_id']]['children'][] = $row;
            }
        }

        return array_values($tree);
    }
}
