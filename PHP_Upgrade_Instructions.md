# Upgrading PHP to 8.2 in Laragon on Windows 11

Follow these steps to upgrade PHP in Laragon to version 8.2:

1. **Download PHP 8.2 for Windows**
   - Go to https://windows.php.net/download/
   - Download the latest PHP 8.2 Non Thread Safe (NTS) zip for your system architecture (x64 or x86).

2. **Extract PHP**
   - Extract the downloaded zip to `C:\laragon\bin\php\php-8.2.x` (create the folder if it doesn't exist).

3. **Configure Laragon to use PHP 8.2**
   - Open Laragon.
   - Go to Menu > PHP > Version > Select `php-8.2.x` (the folder you extracted).
   - Laragon will restart with PHP 8.2.

4. **Verify PHP version**
   - Open Laragon terminal or command prompt.
   - Run `php -v` to confirm PHP 8.2 is active.

5. **Update Composer dependencies**
   - Run `composer update` in your project directory to update dependencies for PHP 8.2.

6. **Run migrations and tests**
   - Run `php artisan migrate` to apply migrations.
   - Test your application.

If you want, I can help you automate some of these steps or provide commands for them.

---

If you are using a system-wide PHP installation or want manual instructions, please let me know.
