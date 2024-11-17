<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная 11 - Соколов М.О. 231-362</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Таблица умножения</h1>
        <nav id="main_menu">
            <a href="?html_type=TABLE<?php if (isset($_GET['content'])) echo '&content=' . $_GET['content']; ?>"
                class="<?php echo ($_GET['html_type'] ?? '') === 'TABLE' && isset($_GET['html_type']) ? 'selected' : ''; ?>">Табличная верстка</a>
            <a href="?html_type=DIV<?php if (isset($_GET['content'])) echo '&content=' . $_GET['content']; ?>"
                class="<?php echo ($_GET['html_type'] ?? '') === 'DIV' && isset($_GET['html_type']) ? 'selected' : ''; ?>">Блочная верстка</a>
        </nav>
    </header>
    <div class="container">
        <aside id="product_menu">
            <a href="?<?php echo isset($_GET['html_type']) ? 'html_type=' . $_GET['html_type'] : ''; ?>"
                class="<?php echo !isset($_GET['content']) && isset($_GET['html_type']) ? 'selected' : ''; ?>">Всё</a>

            <?php for ($i = 2; $i <= 9; $i++): ?>
                <a href="?content=<?php echo $i; ?><?php if (isset($_GET['html_type'])) echo '&html_type=' . $_GET['html_type']; ?>"
                    class="<?php echo (isset($_GET['content']) && $_GET['content'] == $i) ? 'selected' : ''; ?>">Таблица умножения на <?php echo $i; ?></a>
            <?php endfor; ?>
        </aside>
        <main>
            <?php
            // Получаем ссылки
            function outNumAsLink($x)
            {
                $html_type = $_GET['html_type'] ?? 'TABLE'; //получаем текущий тип верстки
                if ($x >= 2 && $x <= 9) {
                    return "<a href='?content=$x&html_type=$html_type'>$x</a>";
                }
                return $x;
            }

            // Вывод таблицы умножения в табличном формате
            function outTableForm($content = null)
            {
                echo "<table class='multiplication-table'>";
                if ($content === null) {
                    // Полная таблица умножения (все множители от 2 до 9)
                    for ($j = 2; $j <= 9; $j++) {
                        echo "<tr>";
                        for ($i = 2; $i <= 9; $i++) {
                            $num = $i * $j;
                            // Добавляем класс "highlighted" только для выбранного множителя
                            $highlightClass = ($content == $i) ? "highlighted" : "";
                            echo "<td class='$highlightClass'>" . outNumAsLink($i) . " × " . outNumAsLink($j) . " = " . outNumAsLink($num) . "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    // Строки с результатами умножения для выбранного множителя
                    for ($i = 2; $i <= 9; $i++) {
                        $num = $content * $i;
                        echo "<tr><td class='highlighted'>" . outNumAsLink($content) . " × " . outNumAsLink($i) . " = " . outNumAsLink($num) . "</td></tr>";
                    }
                }
                echo "</table>";
            }

            // Вывод таблицы умножения в блочном формате
            function outDivForm($content = null)
            {
                echo "<div class='lll'>";
                if ($content === null) {
                    // Перестроим вывод: сначала множители, затем результаты умножения для каждого множителя
                    for ($i = 2; $i <= 9; $i++) {
                        echo "<div class='ttRow'>";
                        for ($j = 2; $j <= 9; $j++) {
                            $num = $i * $j;
                            $highlightClass = ($content == $i) ? "highlighted" : "";
                            echo "<div class='$highlightClass'>" . outNumAsLink($i) . " × " . outNumAsLink($j) . " = " . outNumAsLink($num) . "</div>";
                        }
                        echo "</div>";
                    }
                } else {
                    // Если выбран конкретный множитель, выводим таблицу только для него
                    echo "<div class='ttRow'>";
                    for ($i = 2; $i <= 9; $i++) {
                        $num = $content * $i;
                        echo "<div class='highlighted'>" . outNumAsLink($content) . " × " . outNumAsLink($i) . " = " . outNumAsLink($num) . "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }

            $html_type = $_GET['html_type'] ?? 'TABLE';
            $content = $_GET['content'] ?? null;
            if ($html_type == 'TABLE') {
                outTableForm($content);
            } else {
                outDivForm($content);
            }
            ?>
        </main>
    </div>
    <footer>
        <?php
        $type = ($html_type == 'TABLE') ? "Табличная верстка" : "Блочная верстка";
        $table_type = (!isset($content)) ? "Полная таблица умножения" : "Таблица умножения на {$content}";
        echo "<p><span>{$type}</span> <span>{$table_type}</span> <span>Дата и время: " . date("d.m.Y H:i:s") . "</span></p>";
        ?>
    </footer>
</body>
</html>
