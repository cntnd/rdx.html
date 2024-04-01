<?php
if (!rex_addon::get('markitup')->isAvailable()) {
    echo rex_view::error('Dieses Modul ben&ouml;tigt das "MarkItUp" Addon!');
}

$text = '<div class="text">' . markitup::parseOutput('textile', 'REX_VALUE[id=1 output="html"]') . '</div>' . PHP_EOL;

$slice = $this->getCurrentSlice();
$truncate = (bool)$slice->getValue(2);
$truncate_lines = (int)$slice->getValue(3);
$uuid = uniqid();

if (!rex::isBackend()) {
    if (!$truncate) {
        echo $text;
    }
    else {
        echo '<div class="truncate" id="truncate-'.$uuid.'">'.$text.'</div>';
        echo '<a target="'.$uuid.'" class="read-more">Mehr</a>';
        echo '<a target="'.$uuid.'" class="read-less" style="display: none;">Schliessen</a>';
        ?>
        <script src="https://cdn.jsdelivr.net/npm/trunk8@0.0.1/trunk8.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#truncate-<?= $uuid ?>').trunk8({
                    lines: <?= $truncate_lines ?>,
                    parseHTML: true,
                    tooltip: false,
                    fill: '&hellip;'
                });
                $('.read-more').click(function(){
                    $('#truncate-'+$(this).attr('target')).trunk8('revert');
                    $(this).hide();
                    $('.read-less[target='+$(this).attr('target')+']').show();
                });

                $('.read-less').click(function(){
                    $('#truncate-'+$(this).attr('target')).trunk8();
                    $(this).hide();
                    $('.read-more[target='+$(this).attr('target')+']').show();
                });
            });
        </script>
        <?php
    }
} else {
    ?>
    <div class="bereichswrapper">
        <div class="form-horizontal output">
            <?= $text ?>
            <div class="<?php if (!$truncate) echo "hide"; ?>">
                <strong>Text kürzen aktiviert. Anzahl Zeilen: <?= $truncate_lines ?></strong>
            </div>
        </div>
    </div>
    <?php
}
