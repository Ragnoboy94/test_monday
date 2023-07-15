<?php
require_once 'vendor/autoload.php';




$file = $_GET['file'] ?? '';
$markdownFile = $file . '.md';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    $content = str_replace(['<p>', '</p>', '<br>', '<br />'], '', $content);


    $content = htmlspecialchars_decode($content);


    file_put_contents($markdownFile, $content);

    header('Location: index.php');
    exit;
}


$markdownContent = file_exists($markdownFile) ? file_get_contents($markdownFile) : '';


$parsedown = new Parsedown();
$htmlContent = $parsedown->text($markdownContent);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактировать статью</title>
    <script src="vendor/ckeditor/ckeditor/ckeditor.js"></script>
</head>
<body>
<h1>Редактировать статью</h1>

<form method="post" action="">
    <textarea name="content"><?php echo nl2br(htmlspecialchars($markdownContent)); ?></textarea><br>
    <button type="submit">Сохранить</button>
</form>


<script>
    // Инициализация CKEditor
    CKEDITOR.replace('content');
</script>
</body>
</html>
