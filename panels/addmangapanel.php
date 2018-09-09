<div class = "addMangaDiv">
    <div class = "addmangaButton" onclick = openbox("addmanga")>Добавление манги</div>
    <form id = "addmanga" enctype="multipart/form-data" method = "post" action="?cmd=addmanga">
        <input class = "blockinputLight" placeholder = "Название манги" name = "name" type = "text">
        <input class = "blockinputLight" placeholder = "Год выпуска" name = "year" type = "text">
        <input class = "blockinputLight" placeholder = "Автор" name = "author" type = "text">
        <input class = "blockinputLight" placeholder = "Жанры через запятую" name = "genre" type = "text">
        <input class = "blockinputLight" placeholder = "Перевод" name = "translator" type = "text">
        <textarea placeholder = "Краткое описание, желательно не копировать с других сайтов или хотя бы поменять часть слов на синонимы. Если описание будет скопировано то нам придется придумывать описание самим, что может замедлить публикацию." name = "about"></textarea>
        <input class = "inputLeft" name = "image" type = "file">
        <input class = "submitRight" type = "submit" value = "Добавить">
    </form>
</div>
