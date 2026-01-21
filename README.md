# Laravel Chat Package

Пакет для реализации чата в Laravel приложениях.

## Установка

Установите пакет через Composer:

```bash
composer require jonston/laravel-chat
```

## Публикация ресурсов

### Публикация конфигурации

```bash
php artisan vendor:publish --tag=chat-config
```

### Публикация миграций

```bash
php artisan vendor:publish --tag=chat-migrations
```

После публикации миграций, выполните:

```bash
php artisan migrate
```

## Конфигурация

Конфигурационный файл будет опубликован в `config/chat.php`. В нем можно настроить:

- Названия таблиц
- Модель пользователя
- Настройки пагинации

## Использование

_В разработке..._

## Лицензия

MIT
