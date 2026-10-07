# Laravel Query Optimization

![Laravel](https://laravel.com/img/logomark.min.svg)

[![GitHub stars](https://img.shields.io/github/stars/majid-ali-dev/laravel-query-optimization?style=for-the-badge)](https://github.com/majid-ali-dev/laravel-query-optimization/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/majid-ali-dev/laravel-query-optimization?style=for-the-badge)](https://github.com/majid-ali-dev/laravel-query-optimization/network/members)
[![License](https://img.shields.io/github/license/majid-ali-dev/laravel-query-optimization?style=for-the-badge)](https://github.com/majid-ali-dev/laravel-query-optimization)
![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel 12.x](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL 8.x](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

A hands-on Laravel project demonstrating how database indexes can improve query performance, with benchmarks measured using Laravel Debugbar.

---

## About the Project

This project compares query performance before and after adding an index to a posts table. It uses Laravel Debugbar to inspect SQL queries and a seeded dataset of 1,000 users and 100,000 posts created with batch inserts.

The benchmark focuses on this query:

```sql
SELECT *
FROM posts
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 20;
```

This repository is part of a 14-topic learning roadmap for Laravel query optimization.

---

## Benchmark Results

| Scenario | Index | COUNT time | SELECT time | Approx. speedup |
|---|---|---:|---:|---:|
| Without index | None | 24.2 ms | 116 ms | 1× |
| With index | `user_id` | 0.67 ms | 1.23 ms | ~100× |

Adding an index on `user_id` reduced the measured SELECT time from 116 ms to 1.23 ms. Results can vary based on hardware, database configuration, and data state.

---

## Optimization Roadmap

| # | Topic | Status |
|---:|---|---|
| 1 | Indexing | ✅ Done |
| 2 | EXPLAIN | 🚧 In Progress |
| 3 | N+1 queries | ⏳ Planned |
| 4 | Eager Loading | ⏳ Planned |
| 5 | Select Required Columns | ⏳ Planned |
| 6 | WHERE Optimization | ⏳ Planned |
| 7 | JOIN Optimization | ⏳ Planned |
| 8 | Pagination | ⏳ Planned |
| 9 | Composite Index | ⏳ Planned |
| 10 | Chunk/Lazy | ⏳ Planned |
| 11 | GROUP BY/ORDER BY | ⏳ Planned |
| 12 | Subqueries | ⏳ Planned |
| 13 | Query Caching | ⏳ Planned |
| 14 | Database Caching | ⏳ Planned |

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12.x |
| Language | PHP 8.2+ |
| Database | MySQL 8.x |
| Development tool | Laravel Debugbar |
| Test data | Faker and batch inserts |

---

## Setup Instructions

Follow these steps to run the project locally.

1. Clone the repository:

   ```bash
   git clone https://github.com/majid-ali-dev/laravel-query-optimization.git
   cd laravel-query-optimization
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install Laravel Debugbar for development:

   ```bash
   composer require --dev barryvdh/laravel-debugbar
   ```

4. Configure the environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Set your database credentials in `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=indexing_demo
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Create the database:

   ```bash
   mysql -u root -p -e "CREATE DATABASE indexing_demo;"
   ```

6. Run migrations and seed the database:

   ```bash
   php artisan migrate:fresh --seed
   ```

   This creates 1,000 users and 100,000 posts using batch inserts.

7. Start the development server:

   ```bash
   php artisan serve
   ```

   Visit [http://127.0.0.1:8000/posts](http://127.0.0.1:8000/posts).

---

## How to Test Indexing

Follow these steps to compare query performance with and without the index.

1. **Test with the index.** Open the search page:

   ```text
   http://127.0.0.1:8000/posts/search?user_id=440
   ```

   In Laravel Debugbar, open the Queries tab and note the query time. The indexed query may take around 1 ms in the benchmark environment.

2. **Roll back the index migration.** If the migration that adds the index is the latest migration, run:

   ```bash
   php artisan migrate:rollback --step=1
   ```

3. **Test without the index.** Refresh the same search page and compare the query time in Debugbar. The benchmark without the index was approximately 116 ms.

4. **Re-apply the migration:**

   ```bash
   php artisan migrate
   ```

5. **Verify with EXPLAIN.** In Tinker, inspect the query plan:

   ```bash
   php artisan tinker
   ```

   ```php
   DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 440 ORDER BY created_at DESC LIMIT 20');
   ```

   Without an applicable index, MySQL may scan the table (`type: ALL`, `key: NULL`). With the index, the plan should use an index key. The exact plan details depend on MySQL and the available indexes.

---

## Key Concepts

### Query Optimization

Query optimization is the process of making database queries faster and more efficient so an application remains responsive as its data grows.

### Index

An index is a data structure that helps a database locate matching rows without scanning the entire table. It is similar to a book index that points to relevant pages.

### Why use an index?

- Reduce the time required to find matching rows.
- Improve application performance for frequently used queries.
- Support efficient filtering on large tables, such as `WHERE user_id = ?`.

Indexes also use storage and can add work to inserts and updates, so choose them based on actual query patterns.

---

## Measuring Performance

### Laravel Debugbar

Laravel Debugbar displays executed queries, query counts, and execution times during local development. Install it with:

```bash
composer require --dev barryvdh/laravel-debugbar
```

### EXPLAIN

Use `EXPLAIN` to inspect the query plan MySQL expects to use:

```bash
php artisan tinker
```

```php
DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20');
```

### EXPLAIN ANALYZE

MySQL 8.0.18 and later support `EXPLAIN ANALYZE`, which executes the query and reports actual timing and row counts:

```php
DB::select('EXPLAIN ANALYZE SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20');
```

---

## Resources

- [Laravel 12 documentation](https://laravel.com/docs/12.x)
- [Laravel Eloquent documentation](https://laravel.com/docs/12.x/eloquent)
- [MySQL EXPLAIN output format](https://dev.mysql.com/doc/refman/8.4/en/explain-output.html)
- [Use The Index, Luke!](https://use-the-index-luke.com/)
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)

---

## Contributing

This is a personal learning project, and suggestions or improvements are welcome. Feel free to open an issue or submit a pull request.

## License

This project is distributed under the MIT License. See the `LICENSE` file for details.

---

Built with ❤️ using Laravel
