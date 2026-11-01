<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminNotify;

class Notifications extends BaseController
{
    public function index()
    {
        $db     = db_connect();
        $filter = $this->request->getGet('show') === 'unread' ? 'unread' : 'all';
        $page   = max(1, (int) $this->request->getGet('page'));
        $per    = 20;

        $b = $db->table('admin_notifications');
        if ($filter === 'unread') {
            $b->where('is_read', 0);
        }
        $total = (clone $b)->countAllResults();
        $rows  = $b->orderBy('id', 'DESC')->limit($per, ($page - 1) * $per)->get()->getResultArray();

        return view('admin/notifications/index', [
            'title'      => 'Notifications',
            'adminName'  => session()->get('admin_name'),
            'adminEmail' => session()->get('admin_email'),
            'activeNav'  => 'notifications',
            'rows'      => $rows,
            'filter'    => $filter,
            'page'      => $page,
            'pages'     => max(1, (int) ceil($total / $per)),
            'total'     => $total,
            'unread'    => AdminNotify::unread(),
        ]);
    }

    /** Mark one as read and go to what it points at. */
    public function open(int $id)
    {
        $db = db_connect();
        $n  = $db->table('admin_notifications')->where('id', $id)->get()->getRowArray();
        if (! $n) {
            return redirect()->to(site_url('admin/notifications'));
        }
        $db->table('admin_notifications')->where('id', $id)->update(['is_read' => 1]);

        return redirect()->to(site_url($n['link'] ?: 'admin/notifications'));
    }

    public function readAll()
    {
        db_connect()->table('admin_notifications')->where('is_read', 0)->update(['is_read' => 1]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    /** Polled by the bell: unread count + latest items. */
    public function feed()
    {
        $items = array_map(static fn ($n) => [
            'id' => (int) $n['id'], 'title' => $n['title'], 'body' => $n['body'], 'read' => (bool) $n['is_read'],
            'ago' => AdminNotify::ago($n['created_at']), 'url' => site_url('admin/notifications/' . $n['id'] . '/open'),
        ], AdminNotify::latest(6));

        return $this->response->setJSON(['unread' => AdminNotify::unread(), 'items' => $items]);
    }
}
