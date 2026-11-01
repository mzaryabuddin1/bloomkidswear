<?php
use App\Libraries\Cart;

$m       = static fn ($v) => Cart::money($v);
$methods = ['cod' => 'Cash on delivery', 'card' => 'Card', 'bank' => 'Bank transfer'];
$td      = 'padding:12px 0;border-bottom:1px solid #e6eaf1;';
?>
<!DOCTYPE html>
<html>
<body style="margin:0;padding:0;background:#f2f4f8;font-family:Arial,Helvetica,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f4f8;padding:32px 0;">
    <tr><td align="center">
      <table width="620" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;max-width:96%;">
        <tr><td style="background:#233b61;padding:22px 32px;" align="left">
          <img src="<?= esc($logo, 'attr') ?>" alt="Bloom Kidswear" height="44" style="display:block;height:44px;border:0;">
        </td></tr>
        <tr><td style="padding:32px;color:#233b61;font-size:15px;line-height:1.6;">
          <h1 style="margin:0 0 6px;font-size:22px;">Thank you for your order, <?= esc(explode(' ', trim($order['name'] ?: 'there'))[0]) ?>!</h1>
          <p style="margin:0 0 20px;color:#556f93;">Here is your invoice. We will email you again as your order progresses.</p>

          <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f4f8;border-radius:8px;margin-bottom:20px;">
            <tr>
              <td style="padding:14px 16px;font-size:13px;"><span style="color:#7a90b0;">Invoice / Order no.</span><br><strong style="font-size:16px;">#<?= esc($order['order_number']) ?></strong></td>
              <td style="padding:14px 16px;font-size:13px;"><span style="color:#7a90b0;">Date</span><br><strong><?= esc(date('d M Y', strtotime($order['created_at']))) ?></strong></td>
              <td style="padding:14px 16px;font-size:13px;"><span style="color:#7a90b0;">Payment</span><br><strong><?= esc($methods[$order['payment_method']] ?? $order['payment_method']) ?><?= $order['card_last4'] ? ' ••' . esc($order['card_last4']) : '' ?></strong> (<?= esc($order['payment_status']) ?>)</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;border-collapse:collapse;">
            <tr style="color:#7a90b0;font-size:12px;text-transform:uppercase;">
              <td style="padding:8px 0;border-bottom:1px solid #e6eaf1;">Item</td>
              <td align="center" style="padding:8px 0;border-bottom:1px solid #e6eaf1;">Qty</td>
              <td align="right" style="padding:8px 0;border-bottom:1px solid #e6eaf1;">Price</td>
              <td align="right" style="padding:8px 0;border-bottom:1px solid #e6eaf1;">Total</td>
            </tr>
            <?php foreach ($items as $i): ?>
            <tr>
              <td style="<?= $td ?>"><strong><?= esc($i['name']) ?></strong><?= $i['size'] ? '<br><span style="color:#7a90b0;font-size:12px;">Size ' . esc($i['size']) . '</span>' : '' ?></td>
              <td align="center" style="<?= $td ?>"><?= (int) $i['qty'] ?></td>
              <td align="right" style="<?= $td ?>"><?= $m($i['unit_price']) ?></td>
              <td align="right" style="<?= $td ?>"><?= $m($i['line_total']) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr><td colspan="3" align="right" style="padding:12px 0 2px;color:#556f93;">Subtotal</td><td align="right" style="padding:12px 0 2px;"><?= $m($order['subtotal']) ?></td></tr>
            <tr><td colspan="3" align="right" style="padding:2px 0;color:#556f93;">Delivery</td><td align="right" style="padding:2px 0;"><?= (float) $order['shipping'] > 0 ? $m($order['shipping']) : 'Free' ?></td></tr>
            <tr><td colspan="3" align="right" style="padding:8px 0;font-size:16px;"><strong>Grand total</strong></td><td align="right" style="padding:8px 0;font-size:16px;"><strong><?= $m($order['total']) ?></strong></td></tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:22px;font-size:14px;">
            <tr><td style="color:#7a90b0;font-size:12px;text-transform:uppercase;padding-bottom:4px;">Delivering to</td></tr>
            <tr><td><?= esc($order['name']) ?><br><?= esc($order['address']) ?><br><?= esc(trim($order['city'] . ', ' . $order['province'] . ' ' . $order['postal_code'], ' ,')) ?><br><?= esc($order['phone']) ?></td></tr>
          </table>
        </td></tr>
        <tr><td style="background:#f2f4f8;padding:18px 32px;color:#7a90b0;font-size:12px;text-align:center;">
          Bloom Kidswear · info@bloomkidswear.com · Questions? Just reply to this email.
        </td></tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
