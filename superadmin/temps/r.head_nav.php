<?php

?>

<header class="header black-bg r-bgred">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <a href="#" class="logo"><b><?=$rtype=='superadmin'?'SuperAdmin Dashboard':'Admin Dashboard';?></b></a>
    <div class="nav notify-row" id="top_menu"></div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="<?=RSITE;?>logout.php">Logout</a></li>
        </ul>
    </div>
</header>