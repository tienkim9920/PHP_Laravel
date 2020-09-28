<li class="search"><a style="cursor: pointer;"><i class="fa fa-search"></i></a></li>
<li class="side-menu">
    <a style="cursor: pointer;">
        <i class="fa fa-shopping-bag"></i>
        <span class="badge">
            <?php if (isset($_SESSION['user'])) { ?>
                {{ $countCart }}
            <?php } else { ?>
                {{ $countCart }}
            <?php } ?>
        </span>
        <p>My Cart</p>
    </a>
</li>