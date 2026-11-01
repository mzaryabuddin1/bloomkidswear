<?php

namespace App\Commands;

use App\Libraries\MailQueue;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class MailFlush extends BaseCommand
{
    protected $group       = 'Bloom';
    protected $name        = 'mail:flush';
    protected $description = 'Sends queued emails (order invoices and status updates). Run from cron every minute.';

    public function run(array $params)
    {
        $sent = MailQueue::flush(50);
        CLI::write("Sent {$sent} queued email(s).");
    }
}
