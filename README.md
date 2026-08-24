# Task Manager API ✅

A Laravel REST API for a task manager, built to be consumed by a separate frontend —
the companion single-page app lives at
[to-do-list-spa](https://github.com/DevoidTuna/to-do-list-spa).

The two are deliberately kept as separate deployables rather than one Laravel app
serving Blade views, so the API has no idea what the client is and the client talks to
it the same way any other consumer would.

## API

| Method | Endpoint | Auth | Description |
|---|---|---|---|
| `POST` | `/api/auth/register` | — | Create an account |
| `POST` | `/api/auth/login` | — | Exchange credentials for an access token |
| `POST` | `/api/logout` | ✔ | Revoke the current token |
| `GET` | `/api/tasks` | ✔ | List the authenticated user's tasks |
| `POST` | `/api/tasks` | ✔ | Create a task |
| `GET` | `/api/tasks/{id}` | ✔ | Fetch a single task |
| `PUT` | `/api/tasks/{id}` | ✔ | Update a task |
| `DELETE` | `/api/tasks/{id}` | ✔ | Delete a task |

Authentication is OAuth2 via Laravel Passport. Protected routes sit behind the
`auth:api` guard; unauthenticated requests are redirected to `/api/unauthenticated`,
which returns a JSON 401 instead of Laravel's default HTML redirect to a login page.

## Stack

| Layer | Technology |
|---|---|
| Runtime | PHP 8.2 |
| Framework | Laravel 11 |
| Auth | Laravel Passport (OAuth2) |
| Containers | Laravel Sail (Docker) |

## Running locally

With Docker, via Sail:

```bash
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan passport:install
```

Without Docker, replace `./vendor/bin/sail artisan` with `php artisan` and run
`php artisan serve`.
