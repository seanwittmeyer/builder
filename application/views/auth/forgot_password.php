<!DOCTYPE html>
<html lang="en">
      <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="Sean Wittmeyer">
            <meta name="generator" content="Builder v2005">
            <title><?php echo lang('forgot_password_heading');?></title>
            <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,400;0,600;0,700;1,100;1,400;1,600;1,700&amp;family=IBM+Plex+Sans:ital,wght@0,100;0,400;0,600;0,700;1,100;1,400;1,600;1,700&amp;display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <style>
                  .bd-placeholder-img {
                        font-size: 1.125rem; text-anchor: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;
                  }
                  @media (min-width: 768px) {
                        .bd-placeholder-img-lg {
                              font-size: 3.5rem;
                        }
                  }
                  html,body {
                    height: 100%; font-family: "IBM Plex Mono";
                  }
                  body {
                    display: -ms-flexbox; display: flex; -ms-flex-align: center; align-items: center; padding-top: 40px; padding-bottom: 40px; background-color: #f5f5f5;
                  }
                  .form-signin {
                    width: 100%; max-width: 420px; padding: 15px; margin: auto;
                  }
                  .form-label-group {
                    position: relative; margin-bottom: 1rem;
                  }
                  .form-label-group > input, .form-label-group > label {
                    height: 3.125rem; padding: .75rem;
                  }
                  .form-label-group > label {
                    position: absolute; top: 0; left: 0; display: block; width: 100%; margin-bottom: 0; /* Override default `<label>` margin */ line-height: 1.5; color: #495057; pointer-events: none; cursor: text; /* Match the input under the label */ border: 1px solid transparent; border-radius: .25rem; transition: all .1s ease-in-out;
                  }
                  .form-label-group input::-webkit-input-placeholder {
                    color: transparent;
                  }
                  .form-label-group input:-ms-input-placeholder {
                    color: transparent;
                  }
                  .form-label-group input::-ms-input-placeholder {
                    color: transparent;
                  }
                  .form-label-group input::-moz-placeholder {
                    color: transparent;
                  }
                  .form-label-group input::placeholder {
                    color: transparent;
                  }
                  .form-label-group input:not(:placeholder-shown) {
                    padding-top: 1.25rem; padding-bottom: .25rem;
                  }
                  .form-label-group input:not(:placeholder-shown) ~ label {
                    padding-top: .25rem; padding-bottom: .25rem; font-size: 12px; color: #777;
                  }
                  /* Fallback for Edge
                  -------------------------------------------------- */
                  @supports (-ms-ime-align: auto) {
                    .form-label-group > label {
                      display: none;
                    }
                    .form-label-group input::-ms-input-placeholder {
                      color: #777;
                    }
                  }
                  /* Fallback for IE
                  -------------------------------------------------- */
                  @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                    .form-label-group > label {
                      display: none;
                    }
                    .form-label-group input:-ms-input-placeholder {
                      color: #777;
                    }
                  }
            </style>
      </head>
      <body>
            <?php echo form_open("auth/forgot_password",array('class' => 'form-signin', '_lpchecked' => '1'));?> 
                  <div class="text-center mb-4">
                        <img class="mb-4" src="https://freight.cargo.site/t/original/i/892082e55e8ddf9bf649d7f73fc6500f2803c6779a6a893fe3817387deea366c/7.png" alt="" width="" height="72">
                  </div>
                  <div id="infoMessage" class="mt-5 mb-3 text-muted text-center"><?php echo $message;?></div>
                  <div class="form-label-group">
                        <input type="email" id="identity" class="form-control" placeholder="Email address" required="" autofocus="" autocomplete="off" style="cursor: auto;" name="identity">
                        <label for="identity">Your Email Address</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in!</button>
                  <p class="mt-5 mb-3 text-muted text-center">or...</p>
                  <a href="/auth/login" class="btn btn-lg btn-primary btn-block">Sign in with Email/Pass &rarr;</a> <br />
                  <a href="/auth/facebook" class="btn btn-lg btn-primary btn-block" onclick="$(this).text('signing you in...');">Sign in via Facebook &rarr;</a> <br />
                  <a href="/auth/saml/login/" class="btn btn-lg btn-primary btn-block" onclick="$(this).text('signing you in...');">Sign in via SAML &rarr;</a>
            </form>
      </body>
</html>