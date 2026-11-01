<!DOCTYPE html>
<html>
<body style="margin:0;padding:0;background:#f2f4f8;font-family:Arial,Helvetica,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f4f8;padding:32px 0;">
    <tr><td align="center">
      <table width="520" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;">
        <tr><td style="background:#233b61;padding:22px 32px;color:#ffffff;font-size:22px;font-weight:bold;">Bloom Kidswear</td></tr>
        <tr><td style="padding:32px;color:#233b61;font-size:15px;line-height:1.6;">
          <p style="margin:0 0 16px;"><?= esc($intro) ?></p>
          <p style="margin:24px 0;text-align:center;">
            <span style="display:inline-block;background:#f2f4f8;border:1px dashed #556f93;border-radius:8px;padding:14px 28px;font-size:32px;letter-spacing:8px;font-weight:bold;"><?= esc($code) ?></span>
          </p>
          <p style="margin:0 0 8px;">This code expires in <?= (int) $minutes ?> minutes.</p>
          <p style="margin:0;color:#7a90b0;font-size:13px;">If you did not request this, you can safely ignore this email.</p>
        </td></tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
