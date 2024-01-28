<div class="content">
    <header>
        <div class="tabs">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h2>Ahmed Shop</h2>
        <div class="profile">
            <ul class="ul-main">
                <li>
                    <?php
                    echo $_SESSION['username']; ?> <i class="fas fa-chevron-down icon-rotate" id="icon-arrow"></i>
                    <ul class="ul-sub h-s">
                        <li><a href="change_pass.php">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>