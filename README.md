# Laravel Query Optimization

A hands-on Laravel project that demonstrates how **database indexing** dramatically improves query performance. Includes real benchmarks measured with Laravel Debugbar on a dataset of **100,000+ rows**.

> 📌 This repo is part of a 14-step learning roadmap on Laravel query optimization.

---

## 📖 About the Project

Most tutorials explain what an index is — but rarely show the before/after impact with real data.

This project fixes that.

Every optimization technique here is:
- **Implemented** in a real Laravel app
- **Benchmarked** against 100,000+ seeded rows
- **Verified** using `EXPLAIN` and Laravel Debugbar
- **Documented** with actual millisecond results

---

## 📊 Benchmark Results

**Query tested:**

SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC LIMIT 20;
Dataset: 100,000 posts across 1,000 users

Scenario	Index	COUNT Time	SELECT Time	Speedup <br>
Without Index	❌ None	24.2 ms	116 ms	1x <br>
With Index	✅ user_id	0.67 ms	1.23 ms	~100x <br> <br>
⚡ Adding a single index made this query almost 100x faster.

#	Topic	
1	Indexing

🛠 Tech Stack
Layer	Technology
Framework	Laravel 12.x
Language	PHP 8.2+
Database	MySQL 8.x
Dev Tool	Laravel Debugbar
Seeder	Faker + Batch Inserts
🚀 Setup Instructions
Follow these steps to run the project locally. <br>

1. Clone the repository

git clone https://github.com/majid-ali-dev/laravel-query-optimization.git
cd laravel-query-optimization  <br>

2. Install PHP dependencies

composer install  <br>

3. Install Laravel Debugbar (dev only)

composer require barryvdh/laravel-debugbar --dev

Debugbar shows every SQL query and its execution time at the bottom of each page.  <br>

4. Configure environment

cp .env.example .env
php artisan key:generate
Open .env and set your database credentials:

.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=indexing_demo
DB_USERNAME=root
DB_PASSWORD=  <br>

5. Create the database

mysql -u root -p -e "CREATE DATABASE indexing_demo;"  <br>

6. Run migrations and seed data

php artisan migrate:fresh --seed
This creates:

1,000 users

100,000 posts (using batch inserts — completes in a few seconds)  <br>

7. Start the development server

php artisan serve
Now visit: http://127.0.0.1:8000/posts  <br>

🧪 How to Test Indexing (Step-by-Step)
Follow these steps to see the indexing impact with your own eyes.  <br>

✅ Step 1: Test WITH Index (Default State)
Open the search page:  <br>


http://127.0.0.1:8000/posts/search?user_id=440
Look at Laravel Debugbar at the bottom → click the Queries tab.
 <br>
Find the query:
 <br>

SELECT * FROM posts WHERE user_id = 440 ORDER BY created_at DESC LIMIT 20
Note the execution time. Expected: ~1 ms  <br>

✅ Step 2: Rollback the Index
Open your terminal and run:

 <br>
php artisan migrate:rollback --step=1
This removes the index from the posts table.
 <br>
✅ Step 3: Test WITHOUT Index
Refresh the same search page:

 <br>
http://127.0.0.1:8000/posts/search?user_id=440
Open Debugbar → Queries tab again.
 <br>
Note the new execution time. Expected: ~100+ ms
 <br>
✅ Step 4: Re-Apply the Index
 <br>
php artisan migrate
Refresh the page — you're back to the fast state.
 <br>
✅ Step 5: Verify with EXPLAIN (Optional but Recommended)
 <br>
php artisan tinker
php
DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 440 ORDER BY created_at DESC LIMIT 20');
Look at the output:
 <br>
Without index: type: ALL, key: NULL, Extra: Using filesort

With index: type: ref, key: posts_user_id_index, Extra: Using where
 <br>

🧠 Key Concepts

What is Query Optimization?
The process of making database queries faster and more efficient, so your application stays responsive even with large datasets.

What is an Index?
Think of a book's table of contents. Instead of scanning every page (100,000+ rows), the database jumps directly to the matching records.

Why Use an Index?
Dramatically reduces query time

Improves overall application performance

Essential when filtering large tables (e.g., WHERE user_id = ?)
 <br>
🔬 Measuring Performance
Laravel Debugbar
Install with:

 <br>
composer require barryvdh/laravel-debugbar --dev  <br>
It displays query count, execution time, and the raw SQL at the bottom of every page.
 <br>
EXPLAIN
Run inside Tinker:
 <br>

php artisan tinker
php
DB::select('EXPLAIN SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20');
EXPLAIN ANALYZE (MySQL 8.0.18+)
Gives actual execution times:
 <br>
php
DB::select('EXPLAIN ANALYZE SELECT * FROM posts WHERE user_id = 50 ORDER BY created_at DESC LIMIT 20'); 
 <br>
📚 Resources
Laravel Eloquent Documentation

MySQL EXPLAIN Output Format

Use The Index, Luke!

Laravel Debugbar
 <br>
🤝 Contributing
This is a personal learning project, but suggestions and improvements are welcome. Feel free to open an issue or submit a pull request.
 <br>
📜 License
MIT License — free to use, learn from, and share.
 <br>
⭐ Support
If you found this project helpful, please give it a star — it helps others discover it too.
