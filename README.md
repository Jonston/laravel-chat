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
# Laravel Chat

Лёгкий пакет для добавления базовой функциональности чата в Laravel-проекты.

Ключевые возможности:
- Публикуемые конфигурация и миграции
- Модели для комнат, сообщений и «обёртки» участников
- Сервис `ChatService` для создания комнат, сообщений и управления участниками

## Установка

Установите пакет через Composer (пример):

```bash
composer require jonston/laravel-chat
```

## Публикация ресурсов

Публикация конфигурации:

```bash
php artisan vendor:publish --tag=chat-config
```

Публикация миграций:

```bash
php artisan vendor:publish --tag=chat-migrations
```

Для удобства есть групповой тег `chat`, который публикует и конфиг, и миграции:

```bash
php artisan vendor:publish --tag=chat
```

После публикации миграций выполните:

```bash
php artisan migrate
```

## Конфигурация

Файл `config/chat.php` позволяет настроить:
- Имена таблиц
- Используемые модели (комнат, сообщений, участников, гостей, ботов)
- Параметры пагинации и пр.

По умолчанию модели пакета находятся в `Jonston\LaravelChat\Models` и имена таблиц — в `config/chat.php`.

## Использование

Пример быстрого использования `ChatService` в приложении:

```php
$service = new \Jonston\LaravelChat\Services\ChatService();
$room = $service->createRoom('Support');
$guestClass = config('chat.models.guest');
$guest = ($guestClass)::create(['name' => 'Visitor']);
$member = $service->addMember($guest);
$message = $service->createMessage($member, $room, 'Hello!');
```

## Тесты

Пакет содержит набор unit/feature тестов, которые запускаются через PHPUnit / Orchestra Testbench.

## Контрибьютинг

PR и issues приветствуются.

## Лицензия

MIT
