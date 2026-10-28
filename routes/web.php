<?php
use App\Models\Category;
use App\Models\Proprety;
use App\Models\ListingType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropretyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingTypeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReservationController;

// authentification
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'registerUser']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginUser']);


// Logout route
Route::post('/logout', [UserController::class, 'logoutUser'])->middleware(['auth'])->name('logout');
 
// Home route
Route::get('/', [HomeController::class, 'get'])->name('index')->middleware('auth');

// Routes for Authenticated Users
Route::middleware(['web', '\App\Http\Middleware\CheckSession::class', 'auth'])->group(function () {
    Route::get('/filtered', [FilterController::class, 'show'])->name('show');

    // Categories
    Route::get('/categories/{category}', [FilterController::class, 'show'])->name('categories.show');
    Route::get('/categories', [CategoryController::class, 'get'])->name('categories.index');

    // Properties
    Route::get('/properties', [PropretyController::class, 'get'])->name('properties.index');
    Route::get('/properties/{id}', [PropretyController::class, 'show'])->name('properties.show');
    Route::get('/createproperties', [PropretyController::class, 'create'])->name('createproperties');
    Route::get('/editproperties/{id}', [PropretyController::class, 'edit'])->name('editproperty');
    Route::post('/addproprety', [PropretyController::class, 'add'])->name('addproprety');

    Route::put('/updateproperties/{id}', [PropretyController::class, 'update'])->name('updateproperty');
    Route::delete('/deleteproperties/{id}', [PropretyController::class, 'destroy'])->name('deleteproperty');

    

    // profile
    Route::get('/profile', [ProfileController::class, 'get'])->name('profile');
    Route::get('/editprofile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/updateprofile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

    // Reservations
    Route::post('/properties/{id}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('/api/properties/{id}/blocked-dates', [ReservationController::class, 'getBlockedDates'])->name('properties.blocked-dates');


});


// Admin Routes (Protected by admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Properties Management
    Route::get('/properties', [AdminController::class, 'properties'])->name('properties');
    Route::post('/properties/{id}/approve', [AdminController::class, 'approveProperty'])->name('properties.approve');
    Route::post('/properties/{id}/reject', [AdminController::class, 'rejectProperty'])->name('properties.reject');
    Route::post('/properties/{id}/pending', [AdminController::class, 'pendingProperty'])->name('properties.pending');
    Route::delete('/properties/{id}', [AdminController::class, 'deleteProperty'])->name('properties.delete');

    // Reservations Management
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');

    // Categories Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // Listing Types Management
    Route::get('/listing-types', [AdminController::class, 'listingTypes'])->name('listing-types.index');
    Route::get('/listing-types/create', [AdminController::class, 'createListingType'])->name('listing-types.create');
    Route::post('/listing-types', [AdminController::class, 'storeListingType'])->name('listing-types.store');
    Route::get('/listing-types/{id}/edit', [AdminController::class, 'editListingType'])->name('listing-types.edit');
    Route::put('/listing-types/{id}', [AdminController::class, 'updateListingType'])->name('listing-types.update');
    Route::delete('/listing-types/{id}', [AdminController::class, 'destroyListingType'])->name('listing-types.destroy');
});



