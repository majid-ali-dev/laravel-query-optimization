🔹 Block 1: Header
markdown
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/majid-ali-dev/laravel-query-optimization/stargazers"><img src="https://img.shields.io/github/stars/majid-ali-dev/laravel-query-optimization?style=flat-square" alt="GitHub stars"></a>
  <a href="https://github.com/majid-ali-dev/laravel-query-optimization/network/members"><img src="https://img.shields.io/github/forks/majid-ali-dev/laravel-query-optimization?style=flat-square" alt="GitHub forks"></a>
  <a href="https://github.com/majid-ali-dev/laravel-query-optimization/blob/main/LICENSE"><img src="https://img.shields.io/github/license/majid-ali-dev/laravel-query-optimization?style=flat-square" alt="License"></a>
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=flat-square" alt="Laravel Version">
  <img src="https://img.shields.io/badge/MySQL-8.x-orange?style=flat-square" alt="MySQL Version">
</p>

<h1 align="center">Laravel Query Optimization</h1>

<p align="center">
  A hands-on Laravel project that demonstrates how <strong>database indexing</strong> dramatically improves query performance — with real benchmarks measured on 100,000+ rows.
</p>
🔹 Block 2: About the Project
markdown
## About the Project

Most tutorials explain what an index is — but rarely show the before/after impact with real data. This project fixes that.

Every optimization technique here is:

- **Implemented** in a real Laravel app
- **Benchmarked** against 100,000+ seeded rows
- **Verified** using `EXPLAIN` and Laravel Debugbar
- **Documented** with actual millisecond results

> This repo is part of a 14-step learning roadmap on Laravel query optimization.
🔹 Block 3: Benchmark Results
markdown
## Benchmark Results

**Query tested:**

```sql
SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC LIMIT 20;
Dataset: 100,000 posts across 1,000 users

Scenario	Index	COUNT Time	SELECT Time	Speedup
Without Index	❌ None	24.2 ms	116 ms	1x
With Index	✅ user_id	0.67 ms	1.23 ms	~100x
Adding a single index made this query almost 100x faster.

text

---

### 🔹 Block 4: Optimization Roadmap

```markdown
## Optimization Roadmap

| #   | Topic                   | Status         |
| --- | ----------------------- | -------------- |
| 1   | Indexing                | ✅ Done        |
| 2   | EXPLAIN                 | 🚧 In Progress |
| 3   | N+1 Problem             | ⏳ Planned     |
| 4   | Eager Loading           | ⏳ Planned     |
| 5   | Select Required Columns | ⏳ Planned     |
| 6   | WHERE Optimization      | ⏳ Planned     |
| 7   | JOIN Optimization       | ⏳ Planned     |
| 8   | Pagination              | ⏳ Planned     |
| 9   | Composite Index         | ⏳ Planned     |
| 10  | Chunk / Lazy            | ⏳ Planned     |
| 11  | GROUP BY / ORDER BY     | ⏳ Planned     |
| 12  | Subqueries              | ⏳ Planned     |
| 13  | Query Caching           | ⏳ Planned     |
| 14  | Database Caching        | ⏳ Planned     |

Legend: ✅ Done · 🚧 In Progress · ⏳ Planned
🔹 Block 5: Tech Stack
markdown
## Tech Stack

| Layer     | Technology            |
| --------- | --------------------- |
| Framework | Laravel 12.x          |
| Language  | PHP 8.2+              |
| Database  | MySQL 8.x             |
| Dev Tool  | Laravel Debugbar      |
| Seeder    | Faker + Batch Inserts |
🔹 Block 6: Setup Instructions
markdown
## Setup Instructions

Follow these steps to run the project locally.

### 1. Clone the repository

```bash
git clone https://github.com/majid-ali-dev/laravel-query-optimization.git
cd laravel-query-optimization
2. Install PHP dependencies
bash
composer install
3. Install Laravel Debugbar (dev only)
bash
composer require barryvdh/laravel-debugbar --dev
Debugbar shows every SQL query and its execution time at the bottom of each page.

4. Configure environment
bash
cp .env.example .env
php artisan key:generate
Open .env and set your database credentials:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=indexing_demo
DB_USERNAME=root
DB_PASSWORD=
5. Create the database
bash
mysql -u root -p -e "CREATE DATABASE indexing_demo;"
6. Run migrations and seed data
bash
php artisan migrate:fresh --seed
This creates 1,000 users and 100,000 posts using batch inserts (completes in a few seconds).

7. Start the development server
bash
php artisan serve
Now visit: http://127.0.0.1:8000/posts

text

---

### 🔹 Block 7: How to Test Indexing

```markdown
## How to Test Indexing (Step-by-Step)

### Step 1: Test WITH Index (Default State)

Open the search page: `http://127.0.0.1:8000/posts/search?user_id=440`

Look at **Laravel Debugbar** at the bottom → click the **Queries** tab.

Find the query:

```sql
SELECT * FROM posts WHERE user_id = 440 ORDER BY created_at DESC LIMIT 20
Note the execution time. Expected: ~1 ms

Step 2: Rollback the Index
Open your terminal and run:

bash
php artisan migrate:rollback --step=1
This removes the index from the posts table.

Step 3: Test WITHOUT Index
Refresh the same search page: http://127.0.0.1:8000/posts/search?user_id=440

Open Debugbar → Queries tab again. Note the new execution time. Expected: ~100+ ms

Step 4: Re-Apply the Index
bash
php artisan migrate
Refresh the page — you're back to the fast state.

Step 5: Verify with EXPLAIN (Optional but Recommended)
bash
php artisan tinker
php
DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 440 ORDER BY created_at DESC LIMIT 20');
Look at the output:

Without index: type: ALL, key: NULL, Extra: Using filesort

With index: type: ref, key: posts_user_id_index, Extra: Using where

text

---

### 🔹 Block 8: Key Concepts

```markdown
## Key Concepts

### What is Query Optimization?

The process of making database queries faster and more efficient, so your application stays responsive even with large datasets.

### What is an Index?

Think of a book's **table of contents**. Instead of scanning every page (100,000+ rows), the database jumps directly to the matching records.

### Why Use an Index?

- Dramatically reduces query time
- Improves overall application performance
- Essential when filtering large tables (e.g., `WHERE user_id = ?`)
🔹 Block 9: Measuring Performance
markdown
## Measuring Performance

### Laravel Debugbar

Install with:

```bash
composer require barryvdh/laravel-debugbar --dev
It displays query count, execution time, and the raw SQL at the bottom of every page.

EXPLAIN
Run inside Tinker:

bash
php artisan tinker
php
DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20');
EXPLAIN ANALYZE (MySQL 8.0.18+)
Gives actual execution times:

php
DB::select('EXPLAIN ANALYZE SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20');
text

---

### 🔹 Block 10: Resources

```markdown
## Resources

- [Laravel Eloquent Documentation](https://laravel.com/docs/eloquent)
- [MySQL EXPLAIN Output Format](https://dev.mysql.com/doc/refman/8.0/en/explain-output.html)
- [Use The Index, Luke!](https://use-the-index-luke.com/)
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
🔹 Block 11: Contributing + License
markdown
## Contributing

This is a personal learning project, but suggestions and improvements are welcome. Feel free to open an issue or submit a pull request.

## License

MIT License — free to use, learn from, and share.

---

<p align="center">
  Built with ❤️ using <a href="https://laravel.com">Laravel</a>
</p>
