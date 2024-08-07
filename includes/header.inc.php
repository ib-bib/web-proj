<nav id="navbar">
    <!-- 
    Author: Talal
    Created: July 14
    Modified: July 18
    -->

    <!-- Navigation bar reusable component to avoid redundancy -->
    <!-- an argument is passed to check which page the user is on to underline it -->
    <div>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'index') ? 'current-link' : ''; ?>" class="not-current-link" href="./index.php">Home</a></span>
        <span class="not-current-span">|</span>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'about') ? 'current-link' : ''; ?>" class="not-current-link" href="./about.php">About Us</a></span>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'services') ? 'current-link' : ''; ?>" class="not-current-link" href="./services.php">Services</a></span>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'pricing') ? 'current-link' : ''; ?>" class="not-current-link" href="./pricing.php">Pricing</a></span>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'order') ? 'current-link' : ''; ?>" class="not-current-link" href="./order.php">Order</a></span>
        <span class="not-current-span"><a id="<?php echo ($current_page == 'contact') ? 'current-link' : ''; ?>" class="not-current-link" href="./contact.php">Contact Us</a></span>
    </div>
</nav>