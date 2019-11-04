<h2>Add your news</h2>
<form id="add_post" action="<?= url('/news/postproc') ?>" method="post">
    <label>Title:<input type="text" name="title" value="<?= $_SESSION['title'] ?>"/></label>
    <label>Text:<textarea name="text" id="editor" ><?= $_SESSION['text'] ?></textarea></label>
    <button type="submit">add post</button>
</form>

<script>
    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
</script>
<script src="js/main.js" type="text/javascript"></script>

