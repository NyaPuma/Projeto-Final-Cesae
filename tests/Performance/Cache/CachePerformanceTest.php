<?php

namespace Tests\Performance\Cache;

use Illuminate\Support\Facades\Cache;
use Tests\Performance\PerformanceTestCase;

class CachePerformanceTest extends PerformanceTestCase
{
    public function test_cache_hit_performance(): void
    {
        $key = 'perf_test_cache_hit';
        $value = ['data' => str_repeat('x', 1000)];

        Cache::put($key, $value, 60);

        $time = $this->measureTime(function () use ($key) {
            for ($i = 0; $i < 1000; $i++) {
                Cache::get($key);
            }
        });

        $this->assertLessThanOrEqual(500, $time,
            "1000 cache hits took {$time}ms");
    }

    public function test_cache_miss_performance(): void
    {
        $time = $this->measureTime(function () {
            for ($i = 0; $i < 1000; $i++) {
                Cache::get('nonexistent_key_'.$i);
            }
        });

        $this->assertLessThanOrEqual(500, $time,
            "1000 cache misses took {$time}ms");
    }

    public function test_cache_set_performance(): void
    {
        $time = $this->measureTime(function () {
            for ($i = 0; $i < 1000; $i++) {
                Cache::put('perf_set_'.$i, ['value' => $i], 60);
            }
        });

        $this->assertLessThanOrEqual(1000, $time,
            "1000 cache sets took {$time}ms");
    }

    public function test_cache_with_vs_without(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100);

        $this->asAdmin();

        $withoutCache = $this->measureTime(function () {
            for ($i = 0; $i < 10; $i++) {
                Cache::flush();
                $this->getJson('/analytics/stats');
            }
        });

        $key = 'analytics_stats_cache';
        Cache::put($key, ['cached' => true], 60);

        $withCache = $this->measureTime(function () use ($key) {
            for ($i = 0; $i < 10; $i++) {
                Cache::get($key);
            }
        });

        $this->assertLessThan($withoutCache, $withCache,
            "Cache hits should be faster than cache misses");
    }

    public function test_cache_invalidation_performance(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Cache::put('invalidation_test_'.$i, 'value', 60);
        }

        $time = $this->measureTime(function () {
            for ($i = 0; $i < 100; $i++) {
                Cache::forget('invalidation_test_'.$i);
            }
        });

        $this->assertLessThanOrEqual(500, $time,
            "100 cache invalidations took {$time}ms");
    }

    public function test_cache_memory_usage(): void
    {
        gc_collect_cycles();
        $before = memory_get_usage();

        for ($i = 0; $i < 1000; $i++) {
            Cache::put('mem_test_'.$i, ['data' => str_repeat('x', 100)], 60);
        }

        $after = memory_get_usage();
        $delta = $after - $before;

        $this->assertLessThanOrEqual(10 * 1024 * 1024, $delta,
            "Cache storage used ".($delta / 1024 / 1024).'MB for 1000 entries');

        Cache::flush();
    }

    public function test_ticket_list_repeated_requests_with_cache_simulation(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $this->seedTickets(200);

        $this->asAdmin();

        $directTime = $this->measureTime(function () {
            for ($i = 0; $i < 50; $i++) {
                $this->getJson('/api/tickets');
            }
        });

        $this->assertLessThanOrEqual(5000, $directTime,
            "50 ticket list requests took {$directTime}ms");
    }
}
