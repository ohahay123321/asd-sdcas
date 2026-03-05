<?php include("templates/header.php"); ?>

<?php if(!isset($_SESSION['user_id'])): ?>
    <div class="auth-wrapper single-card">
        
        <div class="card auth-card" id="loginView">
            <h1 class="app-title">MiniBook</h1>
            <h3>Login</h3>
            <form id="loginForm">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p class="toggle-text">No account? <a id="showRegister">Register here</a></p>
        </div>

        <div class="card auth-card" id="registerView" style="display: none;">
            <h1 class="app-title">MiniBook</h1>
            <h3>Register</h3>
            <form id="registerForm" enctype="multipart/form-data">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="file" name="profile_pic">
                <button type="submit">Register</button>
            </form>
            <p class="toggle-text">Already have an account? <a id="showLogin">Login here</a></p>
        </div>
    </div>
<?php endif; ?>

<?php include("templates/footer.php"); ?>