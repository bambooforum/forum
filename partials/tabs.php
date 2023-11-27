<?php
$active_tab = $pageinfo['active_tab'] ?? 1;
?>
<div class="main-tabs">
    <ul>
        <li <?php if($active_tab == 1) echo "class=\"active\"" ?>><a href="/"><?php echo $locals->tabs->forum ?></a></li>
        <li <?php if($active_tab == 2) echo "class=\"active\"" ?>><a href="/users.php"><?php echo $locals->tabs->users ?></a></li>
        <?php
        if(isset($sessiondata['admin']) && $sessiondata['admin'] == '1') {
            echo "<li " . ($active_tab == 3 ? "class=\"active\"":'') . "><a href=\"/admin.php\">" . $locals->tabs->admin . "</a></li>";
        }
        
        ?>
    </ul>
</div>