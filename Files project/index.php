<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css" />
    <title>Document</title>
</head>
<body>
    <header><h1>Automatic Image List</h1></header>
    <main><pre><?php 
        $handle = opendir(__DIR__."/images");
        $images = [];
        $allowedExtensions = [
            "jpg",
            "jpge",
            "png"
        ];
        while (($currentDir = readdir($handle)) !== false) {
            $title = "";
            $content = "";
            if ($currentDir === "." || $currentDir == ".." || $currentDir === ".DS_Store") continue;
            $extension = pathinfo($currentDir, PATHINFO_EXTENSION);
            // if ($extension !== "jpg" && $extension !== "jpge" && $extension !== "png")
            //     continue;
            if (!in_array($extension, $allowedExtensions)) continue;

            $fileWithoutExt = pathinfo($currentDir, PATHINFO_FILENAME);
            $txtFile = __DIR__.'/images/'.$fileWithoutExt.'.txt';
            if (file_exists($txtFile)) {
                $txt = file_get_contents($txtFile);
                $infos = explode("\n", $txt);
                $title = $infos[0];
                unset($infos[0]);
                $content = array_values($infos);
                // var_dump($content);
                // var_dump($txt);
            }

            $images[] = [
                "image" => $currentDir,
                "title" => $title,
                "content" => $content
            ];
            var_dump($currentDir);
            var_dump($extension);
        }
        // var_dump($images);
        closedir($handle);
    ?></pre>
        <?php foreach($images as $image): ?>
            <figure>
                <h1><?php echo $image["title"] ?></h1>
                <img src="images/<?php echo urlencode($image["image"])?>" alt="">
                <figcaption>
                    <?php foreach($image['content'] as $paragraphs): ?>
                        <p><?php echo $paragraphs ?></p>
                    <?php endforeach; ?>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </main>
</body>
</html>