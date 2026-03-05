$(document).ready(function(){
    // --- 1. INITIAL THEME CHECK ---
    if (localStorage.getItem("theme") === "dark") {
        $("body").addClass("dark");
    }

    // --- 2. AUTHENTICATION & FORMS ---
    $("#registerForm").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "ajax/register.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){ alert(data); }
        });
    });

    $("#loginForm").submit(function(e){
        e.preventDefault();
        $.post("ajax/login.php", $(this).serialize(), function(data){
            if(data == "success") { window.location = "dashboard.php"; }
            else { alert(data); }
        });
    });

    // Login/Register Swap Animation
    $("#showRegister").click(function(e){
        e.preventDefault();
        $("#loginView").fadeOut(250, function(){ $("#registerView").fadeIn(250); });
    });

    $("#showLogin").click(function(e){
        e.preventDefault();
        $("#registerView").fadeOut(250, function(){ $("#loginView").fadeIn(250); });
    });

    // --- 3. FEED & INTERACTION ---
    $("#postForm").submit(function(e){
        e.preventDefault();
        $.post("ajax/add_post.php", $(this).serialize(), function(){ location.reload(); });
    });

    $(document).on("click", ".like-btn", function(){
        let id = $(this).data("id");
        $.post("ajax/toggle_like.php", {post_id: id}, function(){ location.reload(); });
    });

    // Infinite Scroll
    let page = 1;
    function loadPosts(){
        $.post("ajax/load_posts.php", {page: page}, function(data){
            if(data.trim() !== ""){ $("#posts").append(data); page++; }
            else { $("#loader").html("No more posts"); }
        });
    }
    if($("#posts").length) { loadPosts(); }
    
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 100){ loadPosts(); }
    });

    // --- 4. DROPDOWNS (THE FIX) ---
    // Notification Toggle
    $("#notifTrigger").on("click", function(e){
        e.stopPropagation();
        $("#notifContent").load("ajax/load_notifications_list.php");
        $(".notif-dropdown").toggleClass("show");
        $(".profile-dropdown").removeClass("show"); // Close other
        
        $.post("ajax/mark_notifications_read.php", function(data){
            if(data == "success"){ $(".badge").text("0").fadeOut(); }
        });
    });

    // Profile Toggle
    $("#profileTrigger").on("click", function(e){
        e.stopPropagation(); 
        $(".profile-dropdown").toggleClass("show");
        $(".notif-dropdown").removeClass("show"); // Close other
    });

    // Close all when clicking anywhere else
    $(window).on("click", function() {
        $(".dropdown-content").removeClass("show");
    });

    // --- 5. DARK MODE & NOTIFS ---
    $(document).on("click", "#darkToggle", function(e){
        e.preventDefault();
        e.stopPropagation();
        $("body").toggleClass("dark");
        
        // Save preference
        if ($("body").hasClass("dark")) {
            localStorage.setItem("theme", "dark");
        } else {
            localStorage.setItem("theme", "light");
        }
        $(".dropdown-content").removeClass("show"); 
    });

    setInterval(function(){
        $.get("ajax/check_notifications.php", function(data){
            if(data > 0) { $(".badge").text(data).fadeIn(); }
        });
    }, 5000);
});

$(document).ready(function(){
    // ... (Keep your existing Theme Check, Auth, and Feed logic) ...

    // --- UPDATED COMMENT LOGIC ---
    $(document).on("keypress", ".comment-field", function(e){
        if(e.which == 13) { // 13 is the 'Enter' key
            let field = $(this);
            let postId = field.data("post-id");
            let text = field.val();

            if(text.trim() !== ""){
                $.post("ajax/add_comment.php", {post_id: postId, comment_text: text}, function(data){
                    if(data.trim() === "success"){
                        // 1. Clear the input
                        field.val(""); 

                        // 2. Match the HTML style from load_posts.php
                        let newComment = `<p class='comment-text' style='display:none;'>${text} - You</p>`;

                        // 3. Append to the specific post list
                        $(`#comments-${postId}`).append(newComment);
                        $(`#comments-${postId} .comment-text`).last().fadeIn();
                    } else {
                        alert("Error adding comment: " + data);
                    }
                });
            }
        }
    });
});