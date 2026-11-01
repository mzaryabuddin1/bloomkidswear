<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table         = 'orders';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['order_number', 'customer_id', 'email', 'status', 'total', 'tracking_number', 'carrier', 'name', 'phone', 'address', 'city', 'province', 'postal_code', 'notes', 'payment_method', 'payment_status', 'card_brand', 'card_last4', 'payment_ref', 'subtotal', 'shipping', 'items_count'];
    protected $useTimestamps = true;
}
