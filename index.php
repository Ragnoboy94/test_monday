<script>
    function searchTable() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            var match = false;
            for (var j = 0; j < td.length; j++) {
                if (td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            tr[i].style.display = match ? "" : "none";
        }
    }

    function filterColumn(columnIndex) {
        var input, filter, table, tr, td, i;
        input = document.getElementById("filterInput" + columnIndex);
        filter = input.value.toLowerCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[columnIndex];
            if (td) {
                if (td.textContent.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Поиск...">

<table id="filterTable">
    <tr>
        <th>Порядковый номер</th>
        <th>URL</th>
        <th>Заголовок</th>
        <th>Кнопка "Редактировать"</th>
        <th>Статус</th>
        <th>Автор</th>
        <th>Категория</th>
        <th>Инструмент</th>
        <th>Просмотры</th>
        <th>Дата публикации</th>
        <th>Дата изменения</th>
    </tr>
    <tr>
        <th><input type="text" id="filterInput0" onkeyup="filterColumn(0)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput1" onkeyup="filterColumn(1)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput2" onkeyup="filterColumn(2)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput3" onkeyup="filterColumn(3)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput4" onkeyup="filterColumn(4)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput5" onkeyup="filterColumn(5)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput6" onkeyup="filterColumn(6)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput7" onkeyup="filterColumn(7)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput8" onkeyup="filterColumn(8)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput9" onkeyup="filterColumn(9)" placeholder="Фильтр"></th>
        <th><input type="text" id="filterInput10" onkeyup="filterColumn(10)" placeholder="Фильтр"></th>
    </tr>
</table>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    input[type="text"] {
        width: 100%;
        box-sizing: border-box;
        padding: 5px;
        margin-bottom: 10px;
    }
</style>
<?php
require_once 'vendor/autoload.php';


$files = glob('*.md');

echo '<table id="dataTable">';
echo '<tr><th>Порядковый номер</th><th>URL</th><th>Заголовок</th><th>Кнопка "Редактировать"</th><th>Статус</th><th>Автор</th><th>Категория</th><th>Инструмент</th><th>Просмотры</th><th>Дата публикации</th><th>Дата изменения</th></tr>';

foreach ($files as $index => $file) {
    $markdownFile = $file;

    $markdownContent = file_get_contents($markdownFile);

    $lines = explode("\n", $markdownContent);

    $title = getValueFromField($lines, 'title');
    $status = getValueFromField($lines, 'status');
    $author = getValueFromField($lines, 'author');

    $category = getValueFromField($lines, 'category');
    $tool = getValueFromField($lines, 'tool');
    $views = getValueFromField($lines, 'views');
    $publishedOn = getValueFromField($lines, 'published_on');
    $modifiedOn = getValueFromField($lines, 'modified_on');
    $url = getURLFromFilename($markdownFile);

    echo '<tr>';
    echo '<td>' . ($index + 1) . '</td>';
    echo '<td>' . $markdownFile . '</td>';
    echo '<td>' . $title . '</td>';
    echo '<td><a href="edit.php?file=' . $url . '">Редактировать</a></td>';
    echo '<td>' . $status . '</td>';
    echo '<td>' . $author . '</td>';
    echo '<td>' . $category . '</td>';
    echo '<td>' . $tool . '</td>';
    echo '<td>' . $views . '</td>';
    echo '<td>' . $publishedOn . '</td>';
    echo '<td>' . $modifiedOn . '</td>';
    echo '</tr>';
}

echo '</table>';



function getValueFromField($lines, $fieldName)
{
    foreach ($lines as $line) {
        if (strpos($line, $fieldName . ':') === 0) {
            $value = trim(substr($line, strlen($fieldName . ':')));
            return $value !== '' ? $value : '-';
        }
    }
    return '-';
}

function getURLFromFilename($filename)
{
    return pathinfo($filename, PATHINFO_FILENAME);
}
?>
