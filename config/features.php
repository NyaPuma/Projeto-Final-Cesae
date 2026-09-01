<?php

declare(strict_types=1);

return [

    'flags' => [
        'ai_recommendations' => (bool) env('FEATURE_AI_RECOMMENDATIONS', true),
        'external_currency_rates' => (bool) env('FEATURE_EXTERNAL_CURRENCY_RATES', true),
    ],

];
