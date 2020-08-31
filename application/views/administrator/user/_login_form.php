<h1> Admin Logins</h1>
<p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
<form action="" class="login-form" method="post">
    <?php flash() ?>
    <div class="row">
        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password"/> </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <!-- <div class="rem-password">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" /> Remember me
                    <span></span>
                </label>
            </div> -->
        </div>
        <div class="col-sm-8 text-right">
            <div class="forgot-password">
                <a href="<?php echo base_url(BACKENDFOLDER . '/retrieve-password') ?>" id="forget-password" class="forget-password">Forgot Password?</a>
            </div>
            <button class="btn bg-dark-gold" type="submit">Sign In</button>
        </div>
    </div>
</form>
