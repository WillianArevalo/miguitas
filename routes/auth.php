<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;

Route::get("/login", [AuthController::class, "showLoginForm"])->name("login");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");
Route::get("/registro", [AuthController::class, "showRegisterForm"])->name("register");
Route::post("/register", [AuthController::class, "register"])->name("register.post");
Route::post("/admin/validate", [AuthController::class, "validateAdmin"])->name("admin.validate");
Route::post("/validate", [AuthController::class, "validate"])->name("login.validate");

Route::get("/auth/google", [GoogleController::class, "redirectToGoogle"])->name("auth.google");
Route::get("/auth/google/callback", [GoogleController::class, "handleGoogleCallback"])->name("auth.google.callback");

Route::get("/password/reset", [AuthController::class, "showResetPasswordForm"])->name("password.reset");
Route::post("/send-email-reset-password", [AuthController::class, "sendEmailResetPassword"])->name("password.send.email");
Route::get("/password-change", [AuthController::class, "showChangePasswordForm"])->name("password.change");
Route::post("/password/reset", [AuthController::class, "changePassword"])->name("password.change.post");

Route::get("/email/verify", [AuthController::class, "showVerifyEmail"])->name("verification.notice");
Route::get("/email/verified", [AuthController::class, "verifyEmail"])->name("verification.verify");
Route::post("/email/resend", [AuthController::class, "resendEmail"])->name("verification.resend");