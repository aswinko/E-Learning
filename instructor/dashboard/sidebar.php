<?php
    $active_path = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +  1);
?>
<!-- ============sidebar========== -->
<div class="navigation" style="z-index: 2;">
        <ul>
            <li>
            <a href="../index.php" class="<?= $active_path == "index.php" ? 'active-sidebar-instructor' : '' ?>">
                <span class="icon pt-1"><i class="fa-sharp fa-solid fa-e"></i></span>
                <span class="text fs-3 fw-bold ps-0 pb-4">Learning</span>
            </a>
            </li>
            <li>
                <a href="./dashboard.php" class="mt-1 <?= $active_path == "dashboard.php" ? 'active-sidebar-instructor' : '' ?>">
                    <span class="icon"><i class="fa-sharp fa-solid fa-house"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./profile.php" class="mt-1 <?= $active_path == "profile.php" ? 'active-sidebar-instructor' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <a href="./manage_course.php" class="mt-1 <?= $active_path == "manage_course.php" ? 'active-sidebar-instructor' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-desktop"></i></span>
                    <span class="text">My Courses</span>
                </a>
            </li>
            <li>
                <a href="./create_course.php" class="mt-1 <?= $active_path == "create_course.php" ? 'active-sidebar-instructor' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-tv"></i></span>
                    <span class="text">Create Course</span>
                </a>
            </li>
            <li>
                <a href="./settings" class="mt-1 <?= $active_path == "settings.php" ? 'active-sidebar-instructor' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-gears"></i></span>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="./logout.php">
                    <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="text">Signout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="toggle" style="z-index: 3;" onclick="toggleMenu()"></div>
    <!-- ====================sidebar ends================= -->