<!DOCTYPE html>

<html lang='en'>

   <head>

      <meta charset='UTF-8'>

      <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>

      <title>Login</title>

      <meta name='theme-color' content='#0c0a0a' />

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>

      <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet'>

      <link rel='stylesheet' href='<?= asset('css/app.css') ?>'>

   </head>>
   <body>

<div class="container" id="container">
   <div class="form-container sign-up-container">
       <form method='post' id='addUserForm' onsubmit='return AddUser()'>
         <input type='hidden' name='_token' value='<?= csrf_token() ?>'>
         <h1>Create Account</h1>
         <span class='signIn-err mt-2 d-none'>Please fill the details</span>
         <input type="text" name="name" id="name" placeholder="Name" />
         <input type="email" name="email" id="email" placeholder="Email" />
         <input type="password" name="password" id="password" placeholder="Password" />
         <button type='submit'>Sign Up</button>
         <span class="succ-msg mt-2 d-none">Account created successfully!!</span>
      </form>

   </div>
   <div class="form-container sign-in-container">
      <form action="<?= route('post-user-login') ?>" method='post' id='loginForm' onsubmit='return userLogin()'>
         <input type='hidden' name='_token' id='csrf-token' value='<?= csrf_token() ?>' />
         <h1>Sign in</h1>
         <span class='frm-err d-none'>Please fill the details</span>

                     <?php

                        if(Session::has('ErrMsg'))  echo '<p class="err_msg">'.Session::get('ErrMsg').'</p>';

                        ?>
         <input type="email" name="email" id="lgnemail" placeholder="Email" />
         <input type="password" name="password" id="lgnpassword" placeholder="Password" />
         <button type='submit'>Sign In</button>
      </form>
   </div>
   <div class="overlay-container">
      <div class="overlay">
         <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
         </div>
         <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
         </div>
      </div>
   </div>
</div>      

   </body>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   <script src='<?= asset('js/app.js') ?>'></script>

</html>
