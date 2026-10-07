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

---

## About the Project

Most tutorials explain what an index is — but rarely show the before/after impact with real data.

This project fixes that.

Every optimization technique here is:

- **Implemented** in a real Laravel app
- **Benchmarked** against 100,000+ seeded rows
- **Verified** using `EXPLAIN` and Laravel Debugbar
- **Documented** with actual millisecond results

> This repo is part of a 14-step learning roadmap on Laravel query optimization.

---

## Benchmark Results

**Query tested:**

```sql
SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC LIMIT 20;
