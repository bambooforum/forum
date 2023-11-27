<div class="pagination-wrapper">
<ul class="pagination-content <?php if($pageinfo['pagination_double']) echo 'pagination-content-double' ?>">
    
</ul>
<div class="controls">
    <ul class="pagination-controls">
        <li><button id="pagination-control-start">&lt;&lt;</button></li>
        <li><button id="pagination-control-previous">&lt;</button></li>
        <li><button id="pagination-control-next">&gt;</button></li>
        <li><button id="pagination-control-end">&gt;&gt;</button></li>
    </ul>
    <ul class="page-controls"><?php
        $pc_button_text = $pageinfo['pagination_button_text'];
        if($pc_button_text != '') {
            echo "<li><button id=\"pagination-page-control-button\">$pc_button_text</button></li>";
        }
    ?></ul>
</div>
</div>    