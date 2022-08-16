<div class="container">
    <h1 class="mt-4 mb-3">Регистрация Пользователя</h1>
    <h3 class="card-header">Регистрация Пользователя</h3>
    <div class="row">
        <div class="">
            <form action="/account/register" method="post">
                    <ul class="col-lg-4 mb-4">
                        <label>Логин:</label>
                        <input type="text" class="" name="login">
                        <label>Фамилия:</label><br>
                        <input type="text" class="" name="family" required>
                        <label>Имя:</label><br>
                        <input type="text" class=" " name="name" required>
                        <label>Отчество:</label><br>
                        <input type="text" class=" " name="name2">
                        <label>Е-mail:</label><br>
                        <input type="text" class=" " name="email">
                        <label>Tелефон:</label><br>
                        <input type="text" class=" " name="wallet">
                    </ul> 
                <h3 class="card-header">Паспортные данные</h3> 
                <p>Ваши данные в безопасности и не будут передаваться третьим лицам без вашего согласия</p>
                    <ul class="col-lg-4 mb-4">
                        <label>Серия:</label><br>
                        <input type="text" class="" name="ser" required>
                        <label>Номер:</label><br>
                        <input type="text" class=" " name="nomer" required>
                        <label>Дата выдачи:</label><br>
                        <input type="text" class=" " name="data1" required>
                        <label>Выдан:</label><br>
                        <input type="text" class=" " name="vidan" required>
                        <label>Код подразделения:</label><br>
                        <input type="text" class=" " name="kod" required>
                    </ul> 
                <h3 class="card-header">Пароль</h3> 
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Пароль</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="control-group form-group">
                <input type = 'checkbox' id = 'bloggood1' onchange = 'showOrHide("bloggood1", "cat1");'/>
                    <label for="html">У меня есть партнерский код</label>
                    <div id = 'cat1' style = 'display: none;'><input value="Введите код"></div>
                </div>
                <div class="control-group form-group">
                    <input id="html" type="checkbox" required>
                    <label for="html">Я ознакомлен и согласен с <a href="">условиями использования</a></label>
                </div> 
                <div class="control-group form-group">
                    <input id="html" type="checkbox" required>
                    <label for="html">Я ознакомлен с <a href="">политикой конфиденциальности</a> и даю согласие на обработку персональных данных.</label>
                </div>                 
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
