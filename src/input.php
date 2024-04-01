<?php

if (!rex_addon::get('markitup')->isAvailable()) {
    echo rex_view::error('Dieses Modul ben&ouml;tigt das "MarkItUp" Addon!');
}
$slice = $this->getCurrentSlice();
$truncate = (bool)$slice->getValue(2);
$truncate_checked = "";
if ($truncate) {
    $truncate_checked = "CHECKED";
}

?>
<div class="modul-content">
    <div>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">Text</label>
                <div class="col-sm-9">
                    <textarea id="markitup_textile_1" class="form-control markitup markitupEditor-simple"
                              name="REX_INPUT_VALUE[1]">REX_VALUE[1]</textarea>
                </div>
            </div>

            <div class="form-group form-check">
                <label class="col-sm-3 control-label"> </label>
                <div class="col-sm-9">
                    <input type="checkbox" class="form-check-input" id="truncate"
                           name="REX_INPUT_VALUE[2]" <?= $truncate_checked ?>>
                    <label class="form-check-label" for="truncate">Text kürzen aktivieren</label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Anzahl Zeilen</label>
                <div class="col-sm-9">
                    <input id="truncate_lines" class="form-control" name="REX_INPUT_VALUE[3]"
                           type="number" value="REX_VALUE[3]" />
                </div>
            </div>
        </div>
    </div>
</div>
