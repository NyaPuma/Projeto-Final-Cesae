# Performance -- Automated Performance Tests

> **New to programming?** See [NON_TECHNICAL_PROJECT_GUIDE.md](../../NON_TECHNICAL_PROJECT_GUIDE.md) -- this folder is explained as "The Stress Testing Lab" that measures how fast and how much the system can handle.

## What is this folder?

These tests measure **speed** and **efficiency**. They verify the system responds quickly, uses memory wisely, doesn't make unnecessary database queries, and can handle growing amounts of data without slowing down.

## Performance Areas Covered

| Folder | What It Measures | Why It Matters |
|--------|-----------------|----------------|
| `APIPerformance/` | How fast API endpoints respond | Slow APIs = frustrated users |
| `DatabasePerformance/` | How many database queries each operation makes | Too many queries = slow pages |
| `NPlusOneQueryTest` | Detects the "N+1" problem (making 100 queries when 1 would do) | This is the #1 cause of slow Laravel apps |
| `LazyLoadingTest` | Detects accidental lazy loading (related data fetched late, one-by-one) | Wastes time and database resources |
| `QueryCountTest` | Verifies operations stay under a query budget | Keeps pages snappy as data grows |
| `CachePerformance/` | Verifies caching actually speeds things up | Cached data loads instantly vs. recomputing |
| `MemoryPerformance/` | How much memory the system uses | Memory leaks = crashes after long use |
| `DashboardPerformance/` | Speed of the analytics dashboard with large datasets | Dashboards must load fast for managers |
| `SearchPerformance/` | Speed of search and filtering | Users expect instant search results |
| `ReportsPerformance/` | Speed of generating reports | Large reports must not time out |
| `ScalabilityPerformance/` | How the system handles growing data volumes | The system must not slow as data grows |
| `UploadsPerformance/` | Speed of file uploads | Photo/document uploads must complete quickly |
| `Authentication/` | Speed of login and auth operations | Login should feel instant |

## How to run these tests

```bash
# All performance tests
php artisan test tests/Performance

# A specific area
php artisan test tests/Performance/DatabasePerformance
php artisan test tests/Performance/MemoryPerformance

# A single test
php artisan test tests/Performance --filter=QueryCountTest
```