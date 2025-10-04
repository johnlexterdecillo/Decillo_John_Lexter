# Authentication & Authorization System - Setup Guide

## 🎯 Overview
A complete authentication and authorization system has been implemented for your Terraria Adventurers web application using the LavaLust PHP framework.

## 📋 Features Implemented

### ✅ Authentication Features
- **User Registration** - New users can create accounts with username, email, password, class, and avatar
- **User Login** - Secure login with username/email and password
- **User Logout** - Complete session cleanup
- **Password Hashing** - Secure bcrypt password encryption
- **Session Management** - Persistent user sessions
- **Remember Me** - Optional persistent login (UI ready)
- **Password Change** - Users can change their passwords

### ✅ Authorization Features
- **Role-Based Access Control (RBAC)** - Users can have roles: `user`, `admin`, `moderator`
- **Protected Routes** - User management requires authentication
- **Admin-Only Actions** - Delete operations restricted to admins
- **Profile Management** - Users can view and edit their profiles

## 🗄️ Database Setup

### Step 1: Run the Migration SQL
Execute the SQL file to add authentication fields to your database:

```bash
# Navigate to your project directory
cd "c:\wamp64\www\NEW REPO\Decillo_John_Lexter"

# Import the migration file using MySQL command line
mysql -u root -p terraria_adventurers < database_auth_migration.sql

# OR use phpMyAdmin to import the file
```

### Step 2: Database Schema
The migration creates/updates the `users` table with these fields:
- `id` - Primary key
- `username` - Unique username (required)
- `email` - Unique email (required)
- `password` - Hashed password (required)
- `class` - User's class (warrior, mage, etc.)
- `avatar` - Avatar filename (optional)
- `role` - User role: `user`, `admin`, `moderator` (default: `user`)
- `last_login` - Last login timestamp
- `created_at` - Account creation timestamp
- `updated_at` - Last update timestamp

### Step 3: Default Users
The migration creates two test accounts:

**Admin Account:**
- Username: `admin`
- Email: `admin@terraria.com`
- Password: `admin123`
- Role: `admin`

**Regular User Account:**
- Username: `testuser`
- Email: `user@terraria.com`
- Password: `user123`
- Role: `user`

## 🚀 Usage

### Accessing the Application

1. **Login Page**: Navigate to `/auth/login`
2. **Register Page**: Navigate to `/auth/register`
3. **Home Page**: Navigate to `/` (redirects to login if not authenticated)

### Authentication Flow

```
┌─────────────┐
│   Visitor   │
└──────┬──────┘
       │
       ├──> /auth/register ──> Create Account ──> Auto-login ──> /users/view
       │
       └──> /auth/login ──> Enter Credentials ──> /users/view
                              │
                              └──> Invalid ──> Error Message
```

### Protected Routes
All routes under `/users/*` require authentication:
- `/users/view` - View all users (authenticated users)
- `/users/create` - Create new user (authenticated users)
- `/users/update/{id}` - Update user (authenticated users)
- `/users/delete/{id}` - Delete user (**admin only**)

### Public Routes
- `/auth/login` - Login page
- `/auth/register` - Registration page
- `/auth/logout` - Logout (destroys session)
- `/auth/unauthorized` - Unauthorized access page

### Authenticated Routes
- `/auth/profile` - User profile page
- `/auth/change_password` - Change password page

## 🔐 Using Auth Library in Controllers

### Require Authentication
```php
public function __construct()
{
    parent::__construct();
    $this->call->library('auth');
    
    // Require authentication for all methods
    $this->auth->require_auth();
}
```

### Require Admin Role
```php
public function delete($id)
{
    // Only admins can access
    $this->auth->require_admin();
    
    // Your delete logic here
}
```

### Check if User is Logged In
```php
if ($this->auth->is_logged_in()) {
    // User is logged in
}
```

### Get Current User
```php
$user = $this->auth->user();
// Returns: ['id', 'username', 'email', 'role', 'class', 'avatar']
```

### Check User Role
```php
if ($this->auth->has_role('admin')) {
    // User is an admin
}

if ($this->auth->is_admin()) {
    // User is an admin (shorthand)
}
```

### Login User Programmatically
```php
$result = $this->auth->login($username, $password);
if ($result['success']) {
    // Login successful
} else {
    // Login failed: $result['message']
}
```

### Register New User
```php
$data = [
    'username' => 'johndoe',
    'email' => 'john@example.com',
    'password' => 'password123',
    'class' => 'warrior',
    'role' => 'user'
];

$result = $this->auth->register($data);
if ($result['success']) {
    // Registration successful
} else {
    // Registration failed: $result['message']
}
```

### Change Password
```php
$result = $this->auth->change_password(
    $user_id, 
    $old_password, 
    $new_password
);
```

### Logout User
```php
$this->auth->logout();
redirect('auth/login');
```

## 📁 File Structure

```
app/
├── controllers/
│   ├── AuthController.php       # Authentication controller
│   └── UserController.php       # User management (protected)
├── models/
│   └── UserModel.php            # User model (updated with auth fields)
├── libraries/
│   └── Auth.php                 # Authentication library
├── views/
│   ├── auth/
│   │   ├── login.php           # Login page
│   │   ├── register.php        # Registration page
│   │   ├── profile.php         # User profile
│   │   ├── change_password.php # Change password page
│   │   └── unauthorized.php    # Access denied page
│   └── users/
│       └── view.php            # User list (with navbar)
└── config/
    └── routes.php              # Routes configuration
```

## 🎨 UI Features

### Login Page
- Clean, modern design with gradient background
- Username/email input
- Password input
- Remember me checkbox (UI ready)
- Link to registration page

### Registration Page
- Username, email, password fields
- Confirm password validation
- Class selection dropdown
- Avatar upload (optional)
- Link to login page

### User Profile Page
- Display avatar
- Show username, email, class
- Role badge (admin/user)
- Links to change password and edit profile

### Navigation Bar
- Shows current user's username
- Admin badge for admin users
- Links to profile and logout

## 🔒 Security Features

1. **Password Hashing** - All passwords are hashed using bcrypt
2. **Session Security** - Sessions include IP and fingerprint matching
3. **CSRF Protection** - Can be enabled in `config.php`
4. **SQL Injection Prevention** - Uses prepared statements
5. **XSS Prevention** - All output is escaped with `htmlspecialchars()`
6. **Role-Based Access** - Granular permission control

## 🛠️ Configuration

### Enable Session in config.php
Sessions are already configured in `app/config/config.php`:
```php
$config['sess_driver']             = 'file';
$config['sess_cookie_name']        = 'LLSession';
$config['sess_expiration']         = 7200; // 2 hours
$config['sess_save_path']          = '/tmp';
```

### Enable CSRF Protection (Optional)
In `app/config/config.php`:
```php
$config['csrf_protection']         = TRUE;
```

### Auto-load Auth Library (Optional)
In `app/config/autoload.php`:
```php
$autoload['libraries'] = array('database', 'session', 'auth');
```

## 🧪 Testing the System

### Test Login
1. Go to `/auth/login`
2. Enter: `admin` / `admin123`
3. Should redirect to `/users/view`
4. See admin badge in navbar

### Test Registration
1. Go to `/auth/register`
2. Fill in the form with unique username/email
3. Upload avatar (optional)
4. Should auto-login and redirect to `/users/view`

### Test Authorization
1. Login as regular user (`testuser` / `user123`)
2. Try to delete a user
3. Should see "Access Denied" page

### Test Profile
1. Login as any user
2. Click "My Profile" in navbar
3. View profile information
4. Click "Change Password" to test password change

## 🐛 Troubleshooting

### Issue: Sessions not working
- Check that `session.save_path` in php.ini is writable
- Or update `sess_save_path` in `config.php` to a writable directory

### Issue: Can't login after running migration
- Make sure database migration ran successfully
- Check that `password` column exists in `users` table
- Try the default credentials: `admin` / `admin123`

### Issue: Avatar upload not working
- Ensure `public/avatars/` directory exists and is writable (777)
- Check PHP `upload_max_filesize` and `post_max_size` settings

### Issue: Redirecting to login on every page
- Check session configuration in `config.php`
- Verify that session library is loaded
- Clear browser cookies and try again

## 📝 Customization

### Add More Roles
Edit the database enum for the `role` column:
```sql
ALTER TABLE users MODIFY role ENUM('user','admin','moderator','vip','premium');
```

Then use in code:
```php
$this->auth->require_role('moderator');
```

### Customize Login Redirect
In `AuthController.php`:
```php
// Redirect admin users to different page
if ($this->auth->is_admin()) {
    redirect('admin/dashboard');
} else {
    redirect('users/view');
}
```

### Add Email Verification
1. Add `email_verified` column to users table
2. Create verification token system
3. Send verification email on registration
4. Check verification status on login

### Add "Remember Me" Functionality
1. Generate secure token on login
2. Store token in database with user_id
3. Set long-lasting cookie
4. Verify token on future visits

## 📚 Additional Resources

- **LavaLust Documentation**: https://lavalust.pinoywap.org/
- **PHP Password Hashing**: https://www.php.net/manual/en/function.password-hash.php
- **Session Security**: https://www.php.net/manual/en/features.session.security.php

## ✅ Checklist

- [x] Database migration completed
- [x] Test admin login works
- [x] Test user registration works
- [x] Test protected routes require login
- [x] Test admin-only delete restriction
- [x] Test password change works
- [x] Test logout clears session

---

**Status**: ✅ Authentication and Authorization System Fully Implemented

**Created**: 2025-10-04
**Framework**: LavaLust PHP MVC
**Database**: MySQL (terraria_adventurers)
