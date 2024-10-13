# TaskTracker

## Описание
Это приложение позволяет добавлять и отслеживать задачи.

## Установка
1. Установите веб-сервер, поддерживающий PHP;

2. Установите MySQL;
  
3. Клонируйте репозиторий:
```bash
git clone https://github.com/AlinaTolchenitsyna/TaskTracker.git
```
4. Подключитесь к MySQL:
```bash
mysql -u root -p
```
5. Создайте базу данных "tasks_db" в MySQL:
```bash
CREATE DATABASE trending_repos;
```
6. Создайте таблицу "tasks":
```bash
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    deadline DATE,
    status ENUM('active', 'completed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
7. Запустите проект на сервере.

### Использование
**Добавление задачи**
- заполните форму добавления задачи;
- нажмите кнопку "Добавить задачу".

**Отметка о выполнении задачи**
- нажмите "Отметить как выполненную" возле необходимой задачи.
