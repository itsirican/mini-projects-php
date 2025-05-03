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
            if ($currentDir === "." || $currentDir == ".." || $currentDir === ".DS_Store") continue;
            $extension = pathinfo($currentDir, PATHINFO_EXTENSION);
            // if ($extension !== "jpg" && $extension !== "jpge" && $extension !== "png")
            //     continue;
            if (!in_array($extension, $allowedExtensions)) continue;

            $fileWithoutExt = pathinfo($currentDir, PATHINFO_FILENAME);
            $txtFile = __DIR__.'/images/'.$fileWithoutExt.'.txt';
            if (file_exists($txtFile)) {
                $txt = file_get_contents($txtFile);
                // var_dump($txt);
            }

            $images[] = [
                "image" => $currentDir,
                "content" => $txt
            ];
            var_dump($currentDir);
            var_dump($extension);
        }
        // var_dump($images);
        closedir($handle);
    ?></pre>
        <?php foreach($images as $image): ?>
            <img src="images/<?php echo urlencode($image["image"])?>" alt="">
            <p><?php echo $image["content"] ?></p>
        <?php endforeach; ?>
    </main>
</body>
</html>