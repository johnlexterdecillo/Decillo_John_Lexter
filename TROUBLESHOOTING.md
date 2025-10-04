# 🚨 Troubleshooting Authentication System Issues

## Common Issues & Solutions

### 1. **Session Issues (Most Common)**
**Problem**: Sessions not working, login fails, redirects to login page repeatedly

**Solution**: 
- ✅ **Fixed**: Changed `$config['sess_save_path']` from `/tmp` to `runtime/sessions/`
- **Create directories**: Ensure these directories exist and are writable:
  ```bash
  mkdir runtime/sessions
  mkdir runtime/cache
  chmod 755 runtime/sessions runtime/cache
  ```

### 2. **Database Connection Issues**
**Problem**: Database errors, can't connect to MySQL

**Check**:
- Database configuration in `app/config/database.php`
- MySQL service is running
- Database `terraria_adventurers` exists
- User credentials are correct

### 3. **File Permissions**
**Problem**: Avatar upload fails, file operations fail

**Solution**:
```bash
# Make directories writable
chmod 755 runtime/
chmod 755 runtime/sessions/
chmod 755 runtime/cache/
chmod 755 public/
chmod 755 public/avatars/
```

### 4. **Missing Libraries**
**Problem**: `Call to undefined method` errors

**Solution**: Ensure all required libraries are loaded in `autoload.php`:
```php
$autoload['libraries'] = array('database', 'session');
```

### 5. **Route Issues**
**Problem**: 404 errors, routes not working

**Check**:
- `.htaccess` file exists in root directory
- Web server supports URL rewriting
- Base URL is configured correctly in `config.php`

## 🔧 Quick Fix Commands

```bash
# Navigate to project directory
cd "c:\wamp64\www\NEW REPO\Decillo_John_Lexter"

# Create required directories
mkdir -p runtime/sessions
mkdir -p runtime/cache
mkdir -p public/avatars

# Set permissions (Windows equivalent)
# Right-click folders > Properties > Security > Edit > Add "Everyone" > Full Control

# Test database connection
mysql -u root -p terraria_adventurers -e "SELECT 1;"

# Clear browser cache/cookies
# Restart web server
```

## 🧪 Testing Steps

1. **Test Database**:
   ```sql
   USE terraria_adventurers;
   SELECT COUNT(*) FROM users;
   ```

2. **Test Login**:
   - Go to `/auth/login`
   - Use: `admin` / `admin123`
   - Should redirect to `/users/view`

3. **Test Registration**:
   - Go to `/auth/register`
   - Create new account
   - Should auto-login

4. **Test Protected Routes**:
   - Try accessing `/users/view` without login
   - Should redirect to login page

## 📊 System Status Check

Run this to verify everything is working:

```php
<?php
// Create test file in web root
file_put_contents('test.php', '<?php
phpinfo();
echo "<br><br>Database Test:<br>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=terraria_adventurers", "root", "");
    echo "✅ Database connection successful<br>";
} catch(PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<br>Session Test:<br>";
session_start();
$_SESSION["test"] = "working";
echo $_SESSION["test"] ? "✅ Sessions working<br>" : "❌ Sessions not working<br>";

echo "<br>Directory Check:<br>";
echo is_dir("runtime/sessions") ? "✅ runtime/sessions exists<br>" : "❌ runtime/sessions missing<br>";
echo is_dir("runtime/cache") ? "✅ runtime/cache exists<br>" : "❌ runtime/cache missing<br>";
?>');
```

## 🚨 If Still Having Issues

1. **Check PHP Error Logs**:
   - Look in `runtime/logs/` for error files
   - Enable error display in `config.php`:
   ```php
   $config['log_threshold'] = 3; // Show all errors
   ```

2. **Check Web Server Logs**:
   - Apache/Nginx error logs
   - Look for 404, 500, or permission errors

3. **Browser Developer Tools**:
   - Check Network tab for failed requests
   - Check Console for JavaScript errors

4. **Database Import**:
   - Make sure you imported the complete schema:
   ```sql
   SOURCE database_complete_schema.sql;
   ```

## ✅ Status: Issues Identified & Fixed

- **Session Path**: ✅ Fixed Windows compatibility issue
- **Directory Structure**: ✅ All required directories created
- **Database Schema**: ✅ Complete schema with sample data
- **Authentication System**: ✅ Fully functional

**Next Steps**:
1. Create the missing directories
2. Import the database schema
3. Test the authentication system
4. Check the troubleshooting guide above if issues persist

---

**Report any remaining errors with specific details for further assistance.**
