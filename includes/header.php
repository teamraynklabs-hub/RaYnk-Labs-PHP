<?php
/**
 * Navigation bar include.
 *
 * Extracted from the original static HTML to keep design identical.
 * NOTE: session_start() should be called in the main page file, not here
 */
?>

<!-- Navigation -->
<nav class="navbar">
    <div class="container">
        <?php
        // Determine logo link based on admin login status
        $logoHref = "admin/index.php";
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['admin_id'])) {
            $logoHref = "admin/dashboard.php";
        }
        ?>
        <?php 
        $currentPage = basename($_SERVER['PHP_SELF']);
        $currentPath = $_SERVER['REQUEST_URI'];
        // Check if we're on the home page (index.php in root, not in public or admin)
        $isHomePage = ($currentPage === 'index.php' && strpos($currentPath, '/public/') === false && strpos($currentPath, '/admin/') === false);
        // If we're on services, courses, or projects pages, it's not home
        if (strpos($currentPath, 'services.php') !== false || strpos($currentPath, 'courses.php') !== false || strpos($currentPath, 'projects.php') !== false) {
            $isHomePage = false;
        }
        ?>
        <?php if (!$isHomePage): ?>
        <a href="javascript:history.back()" class="back-btn" title="Go Back">
            <i class="fas fa-arrow-left"></i>
        </a>
        <?php endif; ?>
        <a class="nav-brand" href="<?php echo htmlspecialchars($logoHref); ?>">RaYnk Labs</a>
        <div class="nav-links" id="navLinks">
            <?php if ($isHomePage): ?>
                <a href="#services">Services</a>
                <a href="#courses">Courses</a>
                <a href="#ai-tools">AI Tools</a>
                <a href="#community">Community</a>
                <a href="#team">Team</a>
                <a href="#contact">Contact</a>
            <?php else: ?>
                <?php 
                // Determine correct path to index.php based on current location
                $indexPath = 'index.php';
                if (strpos($currentPath, '/public/') !== false) {
                    $indexPath = '../index.php';
                } elseif (strpos($currentPath, '/admin/') !== false) {
                    $indexPath = '../index.php';
                }
                ?>
                <a href="<?= $indexPath ?>#services">Services</a>
                <a href="<?= $indexPath ?>#courses">Courses</a>
                <a href="<?= $indexPath ?>#ai-tools">AI Tools</a>
                <a href="<?= $indexPath ?>#community">Community</a>
                <a href="<?= $indexPath ?>#team">Team</a>
                <a href="<?= $indexPath ?>#contact">Contact</a>
            <?php endif; ?>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="theme-toggle-btn" id="themeToggle" title="Toggle Light/Dark Mode">
                <i class="fas fa-moon" id="themeIcon"></i>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

