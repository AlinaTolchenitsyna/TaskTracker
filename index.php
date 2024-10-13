<form action="add_task.php" method="POST">
    <label for="title">Заголовок задачи:</label>
     <input type="text" id="title" required><br>
        
    <label for="description">Описание задачи:</label>
    <textarea id="description"></textarea><br>
        
    <label for="deadline">Дедлайн:</label>
    <input type="date" id="deadline"><br>
        
    <input type="submit" value="Добавить задачу">
</form>

<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'tasks_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $status = isset($_GET['status']) ? $_GET['status'] : 'active';

    $sql = "SELECT * FROM tasks WHERE status = :status ORDER BY deadline ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->execute();
    $tasks = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>

<h2>Список задач</h2>
<a href="?status=active">Активные</a> | <a href="?status=completed">Выполненные</a>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <strong><?= htmlspecialchars($task['title']) ?></strong>
            (Дедлайн: <?= $task['deadline'] ?>)
            - <a href="complete_task.php?id=<?= $task['id'] ?>">Отметить как выполненную</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
foreach ($tasks as $task) {
    $deadline = new DateTime($task['deadline']);
    $now = new DateTime();
    $interval = $now->diff($deadline);

    if ($interval->days <= 2 && $interval->invert == 0) {
        echo "<p>Задача <strong>{$task['title']}</strong> имеет приближающийся дедлайн!</p>";
    }
}
?>