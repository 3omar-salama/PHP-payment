<?php
return [
    'client_id' => 'Ab6M3N2ZXVmUyjq8clUyjNeQg0jIICqYrgAtMCAzgG_ngNvFcVa4BldoYpAODak7gf2UrFrIbBvSg-WR',
    'client_secret' => 'EDhVlODWfKL9lc_pW3gsQc9HnUcgLOkn8CTwLAdJIIinjaLP2m9guNJtVJ8pnu0r7iBRrAGsWzEYfgQa',
    'settings' => [
        'mode' => 'sandbox', // Change to 'live' for production
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'FINE' // Available options: FINE, INFO, WARN, ERROR
    ]
];