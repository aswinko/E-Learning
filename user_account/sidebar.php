<?php
    $active_path = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +  1);
?>
<!-- ============sidebar========== -->
<div class="navigation-user" style="z-index: 1;">
        <ul>
            <li>
            <a href="../index.php" class="<?= $active_path == "index.php" ? 'active-sidebar-user' : '' ?>">
                <span class="icon pt-1"><i class="fa-sharp fa-solid fa-e"></i></span>
                <span class="text fs-3 fw-bold ps-0 pb-4">Learning</span>
            </a>
            </li>
            <li>
                <a href="./profile.php" class="mt-1 <?= $active_path == "profile.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <a href="./my_courses.php" class="mt-1 <?= $active_path == "my_courses.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-regular fa-hard-drive"></i></i></span>
                    <span class="text">My Courses</span>
                </a>
            </li>
            <li>
                <a href="./settings.php" class="mt-1 <?= $active_path == "settings.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-gear"></i></span>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="./logout.inc.php">
                    <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Signout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="toggle" onclick="toggleMenuUser()" style="z-index: 2;"></div>
    <!-- ====================sidebar ends================= -->