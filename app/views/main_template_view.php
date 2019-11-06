<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/css/main.css"/>
        <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <h1>
                <a href="<?= url('/') ?>">SiteName</a>
            </h1>
        </header>
        <nav>
            <ul>
                <li><a href="<?= url('/') ?>">Home</a></li>
		<li><a href="<?= url('/posts') ?>">Posts</a></li>
		<li><a href="<?= url('/posts/authors') ?>">Authors</a></li>
                <li><?php include 'part_auth_view.php'; ?></li>
            </ul>
        </nav>
        <main>
            <?php include_once getAppPath() . 'views' . DIRECTORY_SEPARATOR . $page . '.php'; ?>
        </main>
        <footer>"may" webstudio 2019&copy;</footer>
    </body>
</html>
