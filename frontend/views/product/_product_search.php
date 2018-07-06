<?php if (count($products) > 0) { ?>
<ul class="search-dropdown">
        <?php
        $p = 0;
        foreach ($products as $value) {
                if (isset($value->tag_name)) {
                        $name = $value->tag_name;
                } else if (isset($value->product_name)) {
                        $name = $value->product_name;
                } else if (isset($value->category)) {
                        $name = $value->category;
                }
                $p++;
                ?>
                <li class="<?= $p == 1 ? 'search-selected' : '' ?> searchlist-li" id="<?= $name ?>">
                        <?= $name ?>
                </li>
        <?php } ?>
</ul>
<?php } ?>

