<?php
// Popular searches: each term runs the normal shop search.
$terms = ['Dress', 'Hoodie', 'Pyjama', 'Romper', 'Jacket', 'Shorts', 'Leggings', 'Sweatshirt', 'Newborn', 'Onesie', 'Cardigan', 'Skirt'];
foreach ($terms as $label => $q):
    if (is_int($label)) {
        $label = $q;
        $q     = strtolower($q);
    } ?>
                        <a href="<?= site_url('shop?q=' . urlencode($q)) ?>"><?= esc($label) ?></a>
<?php endforeach; ?>
