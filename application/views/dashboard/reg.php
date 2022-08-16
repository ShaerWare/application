<?php if ($_SESSION['account']['agent'] == 2): ?>
                        
<div class="container">
    <h1 class="mt-4 mb-3">Регистрация Пользователя</h1>
    <h3 class="card-header">Регистрация Пользователя</h3>
    <div class="row">
        <div class="">
            <form action="/dashboard/reg" method="post">
                    <ul class="col-lg-4 mb-4">
                        <label>Логин:</label>
                        <input type="text" class="" name="login">
                         
                        <label>Е-mail:</label><br>
                        <input type="text" class=" " name="email">
                        <label>Tелефон:</label><br>
                        <input type="text" class=" " name="wallet">
                    </ul> 
                   
                <h3 class="card-header">Временный пароль</h3> 
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Пароль</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="control-group form-group">
                                 
                <?php if (isset($this->route['ref'])): ?>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Пригласил:</label>
                            <input type="text" class="form-control" name="ref" value="<?php echo $this->route['ref']; ?>" readonly>
                        </div>
                    </div>
                <?php else: ?>
                    <input type="hidden" class="form-control" name="ref" value="none">
                <?php endif; ?>
               
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <!--<div class="g-recaptcha" data-sitekey="6LdOofMgAAAAADG5fEl3fOpggSIgxa70nMaXqnu9"></div>-->
                <br/>
                <button type="submit" class="btn btn-primary">Регистрация</button><br/><br/><br/><br/><br/><br/>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>