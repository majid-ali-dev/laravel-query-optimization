# Laravel Query Optimization — A Hands-On Guide

A practical, benchmark-driven Laravel project that teaches **database query optimization** from the ground up.

Each optimization technique is implemented, measured with real data (100,000+ rows), and verified using `EXPLAIN` and **Laravel Debugbar**.

> 🎯 **Goal:** Show *why* each optimization matters — not just *how* to do it.

---

## 📚 Table of Contents

- [Why This Project?](#-why-this-project)
- [Tech Stack](#-tech-stack)
- [Setup Instructions](#-setup-instructions)
- [Optimization Roadmap](#-optimization-roadmap)
- [Benchmark Results](#-benchmark-results)
- [Project Structure](#-project-structure)
- [Key Concepts Explained](#-key-concepts-explained)
- [How to Measure Performance](#-how-to-measure-performance)
- [Resources](#-resources)
- [License](#-license)

---

## 🎯 Why This Project?

Most tutorials explain *what* an index is, but rarely show the **before/after impact** with real data. This project fixes that.

Every optimization technique in this repo is:
1. **Implemented** in a real Laravel app
2. **Benchmarked** against 100,000+ seeded rows
3. **Verified** using `EXPLAIN` and Debugbar timings
4. **Documented** with actual millisecond results

Whether you're preparing for a backend interview or optimizing a production app, this repo gives you the vocabulary, the tools, and the numbers.

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | Laravel 11.x |
| Language | PHP 8.2+ |
| Database | MySQL 8.x |
| Dev Tool | [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) |
| Seeder | Faker + batch inserts |
| Frontend | Bootstrap 5 (via CDN) |

---

## ⚙️ Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/laravel-query-optimization.git
cd laravel-query-optimization
