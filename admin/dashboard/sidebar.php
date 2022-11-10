<?php
    $active_path = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +  1);
?>
<!-- ============sidebar========== -->
<div class="navigation-user" style="z-index: 2;">
        <ul>
            <li>
            <a href="../index.php">
                <span class="icon pt-1"><i class="fa-sharp fa-solid fa-e"></i></span>
                <span class="text fs-3 fw-bold ps-0 pb-4">Learning</span>
            </a>
            </li>
            <li>
                <a href="./index.php" class="mt-1 <?= $active_path == "index.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-desktop"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./manage_courses.php" class="mt-1 <?= $active_path == "manage_courses.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-tv"></i></span>
                    <span class="text">Manage Course</span>
                </a>
            </li>
            <li>
                <a href="./manage_instructor.php" class="mt-1 <?= $active_path == "manage_instructor.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-chalkboard-user"></i></span>
                    <span class="text">Manage Instructor</span>
                </a>
            </li>
            <li>
                <a href="./manage_user.php" class="mt-1 <?= $active_path == "manage_user.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="text">Manage user</span>
                </a>
            </li>
            <li>
                <a href="./manage_category.php" class="mt-1 <?= $active_path == "manage_category.php" ? 'active-sidebar-user' : '' ?>">
                    <span class="icon"><i class="fa-solid fa-sitemap"></i></span>
                    <span class="text">Manage Category</span>
                </a>
            </li>
            
            <li>
                <a href="./settings" class="mt-1 <?= $active_path == "settings.php" ? 'active-sidebar-user' : '' ?>">
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
    <div class="toggle" style="z-index: 3;" onclick="toggleMenuAdmin()"></div>
    <!-- ====================sidebar ends================= -->