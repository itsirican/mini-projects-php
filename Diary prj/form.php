<?php 
    require_once __DIR__."/inc/db-connect.inc.php";
    require_once __DIR__."/inc/functions.inc.php";

    // $title = "";
    // $date = "";
    // $message = "";
    if (!empty($_POST)) {
        // var_dump($_POST["title"]);
        $title = (string) ($_POST["title"] ?? '');
        $date = (string) ($_POST["date"] ?? '');
        $message = (string) ($_POST["message"] ?? '');
        $imageName = null;
        if (!empty($_FILES) && !empty($_FILES["image"])) {
            if ($_FILES["image"]["error"] === 0 && $_FILES["image"]["size"] !== 0) {
              $fileWithoutExt = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
              $name = preg_replace('/[^a-zA-Z0-9]/', '', $fileWithoutExt);
              $originalImage = $_FILES["image"]["tmp_name"];
              $imageName = $name."-".time().".jpg";
              $destImage = __DIR__.'/uploads/'.$imageName;
              // move_uploaded_file(, );
        
              [$width, $height] = getimagesize($originalImage);
              $maxDims = 400;
              $scaleFactor = $maxDims / max($width, $height);
              $newWidth = $width * $scaleFactor;
              $newHeight = $height * $scaleFactor;
            
              $im = imagecreatefromjpeg($originalImage);
              // var_dump($im);
            
              $newImage = imagecreatetruecolor($newWidth, $newHeight);
              imagecopyresampled($newImage, $im, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
              // header("Content-Type: image/jpeg");
              // imagejpeg($newImage);
            
              imagejpeg($newImage, $destImage);
            //   var_dump($imageName);
            }
        }

        $stmt = $pdo->prepare("INSERT INTO `enteries` (`title`, `date`, `message`, `image`) VALUES (:title, :message, :date, :image)");
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":date", $date);
        $stmt->bindValue(":message", $message);
        $stmt->bindValue(":image", $imageName);
        $stmt->execute();
        
        echo '<a href="index.php">Continue to the diary</a>';
        die();
    }
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
<h1 class="main-heading">New Entry</h1>

<form method="POST" action="form.php" enctype="multipart/form-data">
    <div class="form-group">
        <label class="from-group__label" for="title">Title:</label>
        <input class="from-group__input" type="text" id="title" name="title" required />
    </div>
    <div class="form-group">
        <label class="from-group__label" for="date">Date:</label>
        <input class="from-group__input" type="date" id="date" name="date" required />
    </div>
    <div class="form-group">
        <label class="from-group__label" for="image">Image:</label>
        <input class="from-group__input" type="file" id="image" name="image" />
    </div>
    <div class="form-group">
        <label class="from-group__label" for="message">Message:</label>
        <textarea class="from-group__input" id="message" name="message" rows="6" required></textarea>
    </div>
    <div class="form-submit">
        <button class="button">
            <svg class="button__icon" viewBox="0 0 34.7163912799 33.4350009649">
                <g style="fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2px;">
                    <polygon points="20.6844359446 32.4350009649 33.7163912799 1 1 10.3610302393 15.1899978903 17.5208901631 20.6844359446 32.4350009649"/>
                    <line x1="33.7163912799" y1="1" x2="15.1899978903" y2="17.5208901631"/>
                </g>
            </svg>
            Save!
        </button>
    </div>
</form>
<?php require_once __DIR__."/views/footer.view.php"; ?>