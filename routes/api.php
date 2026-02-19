<?php
/*
 * Created on Tue May 20 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

use Illuminate\Support\Facades\Route;

// Include versioned route files
Route::prefix('v1')->group(base_path('routes/api/v1.php'));