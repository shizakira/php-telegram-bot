# Telegram Balance Bot

Тестовое задание на позицию “Backend php developer (junior)”

## Установка и запуск

### 1. Настройка окружения
Создайте файл `.env` в корне проекта, скопировав пример из `.env.example`:
  ```bash
  cp .env.example .env
  ```
Откройте `.env` и заполните переменные окружения:
  ```
  TELEGRAM_TOKEN=ваш_токен_бота
  POSTGRES_USER=ваш_пользователь
  POSTGRES_PASSWORD=ваш_пароль
  ```
Пользователя и пароль можно оставить по умолчанию.

### 2. Запуск проекта
Убедитесь, что Docker и Docker Compose установлены.
Запустите приложение с помощью команды:
  ```bash
  docker-compose up -d
  ```
## Управление проектом

### Остановка
Для остановки контейнеров выполните:
```bash
docker-compose down
```

### Перезапуск
Чтобы перезапустить проект:
```bash
docker-compose down && docker-compose up -d
```

