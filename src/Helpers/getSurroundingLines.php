<?php
/**
 * Возвращает набор строк на основании указанного файла и строки, несколько до и после
 */
function getSurroundingLines($filePath, $lineNumber, $contextLines = 5) {
    // Проверяем, существует ли файл
    if (!file_exists($filePath)) {
        return "Файл не существует.";
    }

    // Читаем все строки файла в массив
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        return "Не удалось прочитать файл.";
    }

    // Проверяем, существует ли указанная строка
    if ($lineNumber < 1 || $lineNumber > count($lines)) {
        return "Указанная строка не существует в файле.";
    }

    // Определяем реальный диапазон строк для вывода
    $start = max(1, $lineNumber - $contextLines);
    $end = min(count($lines), $lineNumber + $contextLines);

    // Собираем нужные строки
    $result = [];
    for ($i = $start; $i <= $end; $i++) {
        $result[] = $lines[$i - 1]; // Массив начинается с 0, строки нумеруются с 1
    }

    // Объединяем строки через перенос строки
    return implode("\n", $result);
}
