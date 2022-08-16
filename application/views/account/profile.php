<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/profile" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Логин:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['login']; ?>" disabled>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Фамилия:</label><br>
                        <input type="text" class="form-control" name="family" value="<?php echo $_SESSION['account']['family']; ?>">
                        <label>Имя:</label><br>
                        <input type="text" class="form-control" name="name" value="<?php echo $_SESSION['account']['name']; ?>">
                        <label>Отчество:</label><br>
                        <input type="text" class="form-control"  value="<?php echo $_SESSION['account']['name2']; ?>" name="name2">
                    </div>
                </div> <?php print_r($_SESSION['account'])?>
                <h3 class="card-header">Паспортные данные</h3> 
                <p>Ваши данные в безопасности и не будут передаваться третьим лицам без вашего согласия</p>
                    <ul class="col-lg-4 mb-4">
                        <label>Серия:</label><br>
                        <input type="text" class="form-control" name="ser" value="<?php echo $_SESSION['account']['ser']; ?>">
                        <label>Номер:</label><br>
                        <input type="text" class="form-control" name="nomer" value="<?php echo $_SESSION['account']['nomer']; ?>">
                        <label>Дата выдачи:</label><br>
                        <input type="text" class="form-control" name="data1" value="<?php echo $_SESSION['account']['data']; ?>">
                        <label>Выдан:</label><br>
                        <input type="text" class="form-control" name="vidan" value="<?php echo $_SESSION['account']['vidan']; ?>">
                        <label>Код подразделения:</label><br>
                        <input type="text" class="form-control" name="kod" value="<?php echo $_SESSION['account']['kod']; ?>">
                    </ul> 
                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control"  value="<?php echo $_SESSION['account']['email']; ?>" name="email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Телефон:</label>
                        <input type="text" class="form-control"  value="<?php echo $_SESSION['account']['wallet']; ?>" name="wallet">
                    </div>
                </div>
                <h3 class="card-header">Новый пароль для входа</h3> 
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Новый пароль для входа:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                
                
                <?php if ($_SESSION['account']['agent'] == 5): ?>
                    <p><input type="checkbox" name="agent" value="1">  - Заявка на смену статуса "Агенты"</p><Br>
                <?php elseif ($_SESSION['account']['agent'] == 1): ?>
                    <p>Ваша заявка на получение статуса Агента на рассмотрении</p>
                <?php elseif ($_SESSION['account']['agent'] == 2): ?>
                    <p><input type="checkbox" name="agent" value="3">  - Заявка на смену статуса на "Обычные пользователи"</p><Br>
                <?php elseif ($_SESSION['account']['agent'] == 3): ?>
                    <p>Ваша заявка на получение статуса Обычные пользователи на рассмотрении</p>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>