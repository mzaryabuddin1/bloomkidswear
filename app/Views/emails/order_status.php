<?php
use App\Libraries\Cart;

$m  = static fn ($v) => Cart::money($v);
$td = 'padding:8px 0;border-bottom:1px solid #e6eaf1;';
?>
<!DOCTYPE html>
<html>
<body style="margin:0;padding:0;background:#f2f4f8;font-family:Arial,Helvetica,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f4f8;padding:32px 0;">
    <tr><td align="center">
      <table width="560" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;max-width:96%;">
        <tr><td style="background:#233b61;padding:22px 32px;" align="left">
          <img src="<?= esc($logo, 'attr') ?>" alt="Bloom Kidswear" height="44" style="display:block;height:44px;border:0;">
        </td></tr>
        <tr><td style="padding:32px;color:#233b61;font-size:15px;line-height:1.6;">
          <p style="margin:0 0 6px;color:#7a90b0;font-size:13px;">Order #<?= esc($order['order_number']) ?></p>
          <h1 style="margin:0 0 12px;font-size:22px;"><?= esc($headline) ?></h1>
          <p style="margin:0 0 20px;">Hi <?= esc(explode(' ', trim($order['name'] ?: 'there'))[0]) ?>, <?= esc($text) ?></p>
          <p style="margin:0 0 20px;"><span style="display:inline-block;background:#233b61;color:#fff;border-radius:999px;padding:6px 16px;font-size:13px;font-weight:bold;text-transform:uppercase;letter-spacing:.5px;"><?= esc($order['status']) ?></span></p>
          <?php if ($order['status'] === 'shipped' && ($order['tracking_number'] || $order['carrier'])): ?>
          <p style="margin:0 0 20px;background:#f2f4f8;border-radius:8px;padding:12px 16px;font-size:14px;">
            <?= $order['carrier'] ? 'Courier: <strong>' . esc($order['carrier']) . '</strong><br>' : '' ?>
            <?= $order['tracking_number'] ? 'Tracking number: <strong>' . esc($order['tracking_number']) . '</strong>' : '' ?>
          </p>
          <?php endif; ?>
          <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;border-top:1px solid #e6eaf1;">
            <?php foreach ($items as $i): ?>
            <tr><td style="<?= $td ?>"><?= esc($i['name']) ?><?= $i['size'] ? ' (' . esc($i['size']) . ')' : '' ?> × <?= (int) $i['qty'] ?></td><td align="right" style="<?= $td ?>"><?= $m($i['line_total']) ?></td></tr>
            <?php endforeach; ?>
            <tr><td style="padding:10px 0;"><strong>Total</strong></td><td align="right" style="padding:10px 0;"><strong><?= $m($order['total']) ?></strong></td></tr>
          </table>
        </td></tr>
        <tr><td style="background:#f2f4f8;padding:18px 32px;color:#7a90b0;font-size:12px;text-align:center;">Bloom Kidswear · info@bloomkidswear.com</td></tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
