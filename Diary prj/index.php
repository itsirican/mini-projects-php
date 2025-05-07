<?php
    require_once __DIR__."/inc/functions.inc.php";
    require_once __DIR__."/inc/db-connect.inc.php";
    $perPage = 2;
    $page = (int) ($_GET["page"] ?? 1);
    if ($page < 0) {
        $page = 1;
    }
    // $page = 1 => offset = 0
    // $page = 2 => offset = perPage
    // $page = 3 => offset = perPage * 2

    $offset = ($page - 1) * $perPage;
    $stmt = $pdo->prepare('SELECT * FROM enteries ORDER BY `date` DESC, `id` DESC LIMIT :perPage OFFSET :offset');
    $stmt->bindValue("perPage", (int) $perPage, PDO::PARAM_INT);
    $stmt->bindValue("offset", (int) $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtCount = $pdo->prepare('SELECT COUNT(*) as `count` FROM `enteries`');
    $stmtCount->execute();
    $count = $stmtCount->fetch()["count"];

    $numPages = ceil($count / $perPage);
?>
<?php require_once __DIR__."/views/header.view.php"; ?>
<div class="nav__layout">
    <a href="index.php" class="nav-brand">
        <svg class="nav-brand__image" viewBox="0 0 60.7863869853 60.7863869853">
            <path style="fill: currentColor" d="m45.589790239,30.3931934927c8.3928407749,0,15.1965967463-6.8037559715,15.1965967463-15.1965967463S53.9826310139,0,45.589790239,0H15.196554313C6.8037135382,0,0,6.8037559715,0,15.1965967463v30.3931934927c0,8.3928407749,6.8037135382,15.1965967463,15.196554313,15.1965967463h30.393235926c8.3928407749,0,15.1965967463-6.8037559715,15.1965967463-15.1965967463s-6.8037559715-15.1965967463-15.1965967463-15.1965967463Z"/>
        </svg>
        PHP Diary
    </a>
    <a href="form.php" class="button">
        <svg class="button__icon" viewBox="0 0 44.4901230052 44.4901230053">
            <g style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round;stroke-width: 2px;">
                <circle cx="22.2450615026" cy="22.2450615026" r="21.2450615026"/>
                <line x1="22.2450615026" y1="13.4699274037" x2="22.2450615026" y2="31.0201956015"/>
                <line x1="31.0201956015" y1="22.2450658041" x2="13.4699274037" y2="22.2450572011"/>
            </g>
        </svg>
        New entry
    </a>
</div>
</div>
</nav>
<main class="main">
<div class="container">
<h1 class="main-heading">Entries</h1>
<?php foreach($results as $entry): ?>
    <div class="card">
        <?php if (!empty($entry["image"])): ?>
            <div class="card__image-container">
                <img class="card__image" src="uploads/<?php echo $entry["image"]; ?>" alt="" />
            </div>
        <?php endif; ?>
        <div class="card__desc-container">
            <?php 
                $dateExploded = explode("-", $entry["date"]);
                $timestamp = mktime(12, 0, 0, $dateExploded[1], $dateExploded[2], $dateExploded[0]);
            ?>
            <div class="card__desc-time"><?php echo e(date("m/d/Y", $timestamp)) ?></div>
            <h2 class="card__heading"><?php echo e($entry["title"]) ?></h2>
            <p class="card__paragraph"><?php echo nl2br(e($entry["message"])) ?></p>
        </div>
    </div>
<?php endforeach; ?>
<!-- <div class="card">
    <div class="card__image-container">
        <img class="card__image" src="images/pexels-tranmautritam-68761.jpg" alt="" />
    </div>
    <div class="card__desc-container">
        <div class="card__desc-time">Week 1</div>
        <h2 class="card__heading">PHP is amazing!</h2>
        <p class="card__paragraph">
            PHP, a widely used server-side scripting language, stands out for its remarkable ease of use, extensive community support, and flexibility. It integrates seamlessly with HTML, making it ideal for web development, and offers a vast array of frameworks that streamline the development process. PHP's compatibility with various databases, its cost-effectiveness (being open-source), and its constant evolution with regular updates contribute to its enduring popularity and cool factor in the web development world.
        </p>
    </div>
</div>

<div class="card">
    <div class="card__image-container">
        <img class="card__image" src="images/pexels-lumn-167682.jpg" alt="" />
    </div>
    <div class="card__desc-container">
        <div class="card__desc-time">Week 1</div>
        <h2 class="card__heading">PHP is amazing!</h2>
        <p class="card__paragraph">
            PHP, a widely used server-side scripting language, stands out for its remarkable ease of use, extensive community support, and flexibility. It integrates seamlessly with HTML, making it ideal for web development, and offers a vast array of frameworks that streamline the development process. PHP's compatibility with various databases, its cost-effectiveness (being open-source), and its constant evolution with regular updates contribute to its enduring popularity and cool factor in the web development world.
        </p>
    </div>
</div>

<div class="card">
    <div class="card__image-container">
        <img class="card__image" src="images/pexels-kaushal-moradiya-2781195.jpg" alt="" />
    </div>
    <div class="card__desc-container">
        <div class="card__desc-time">Week 1</div>
        <h2 class="card__heading">PHP is amazing!</h2>
        <p class="card__paragraph">
            PHP, a widely used server-side scripting language, stands out for its remarkable ease of use, extensive community support, and flexibility. It integrates seamlessly with HTML, making it ideal for web development, and offers a vast array of frameworks that streamline the development process. PHP's compatibility with various databases, its cost-effectiveness (being open-source), and its constant evolution with regular updates contribute to its enduring popularity and cool factor in the web development world.
        </p>
    </div>
</div> -->

<?php if($numPages > 1): ?>
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="pagination__li">
                <a class="pagination__link" href="index.php?<?php echo http_build_query(["page" => $page - 1]); ?>">⏴</a>
            </li>
        <?php endif; ?>
        <?php for($x = 1; $x <= $numPages; $x++): ?>
            <li class="pagination__li">
                <a class="pagination__link <?php if($x === $page): ?><?php echo 'pagination__link--active' ?><?php endif; ?>" 
                href="index.php?<?php echo http_build_query(["page" => $x]) ?>"><?php echo $x ?></a>
            </li>
        <?php endfor; ?>
        <?php if($page <= $numPages - 1): ?>
            <li class="pagination__li">
                <a class="pagination__link" href="index.php?<?php echo http_build_query(["page" => ($page + 1)]) ?>">⏵</a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php require_once __DIR__."/views/footer.view.php"; ?>