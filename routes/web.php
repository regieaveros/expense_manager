<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login
Route::get('/', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Auth::routes();

//Dashboard
Route::get('/', 'HomeController@index')->name('dashboard')->middleware('auth');

//Roles
Route::get('roles', function () {
    return view('layouts.backend.roles');
})->name('roles')->middleware('auth');
Route::get('roles/data', 'RoleController@index')->middleware('auth');
Route::post('roles/store', 'RoleController@store')->middleware('auth');
Route::put('roles/update/{id}', 'RoleController@update')->middleware('auth');
Route::delete('roles/delete/{id}', 'RoleController@destroy')->middleware('auth');

//Users
Route::get('users', function () {
    return view('layouts.backend.users');
})->name('users')->middleware('auth');
Route::get('users/data', 'UserController@index')->middleware('auth');
Route::get('users/profile', 'UserController@profile_index')->middleware('auth');
Route::get('users/profile', 'UserController@profile_index')->middleware('auth');
Route::post('users/store', 'UserController@store')->middleware('auth');
Route::put('users/update/{id}', 'UserController@update')->middleware('auth');
Route::put('users/profile/{id}', 'UserController@profile_update')->middleware('auth');
Route::delete('users/delete/{id}', 'UserController@destroy')->middleware('auth');

//Expense Categories
Route::get('expense-categories', function () {
    return view('layouts.backend.expense-categories');
})->name('expense-categories')->middleware('auth');
Route::get('expense-categories/data', 'ExpenseCategoryController@index')->middleware('auth');
Route::post('expense-categories/store', 'ExpenseCategoryController@store')->middleware('auth');
Route::put('expense-categories/update/{id}', 'ExpenseCategoryController@update')->middleware('auth');
Route::delete('expense-categories/delete/{id}', 'ExpenseCategoryController@destroy')->middleware('auth');

//Expenses
Route::get('expenses', function () {
    return view('layouts.backend.expenses');
})->name('expenses')->middleware('auth');
Route::get('expenses/data', 'ExpenseController@index')->middleware('auth');
Route::post('expenses/store', 'ExpenseController@store')->middleware('auth');
Route::put('expenses/update/{id}', 'ExpenseController@update')->middleware('auth');
Route::delete('expenses/delete/{id}', 'ExpenseController@destroy')->middleware('auth');
