<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($list)): ?>
                            <p>users</p>
                        <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Статус аккаунта</th>
                                        
                                        <th>Логин</th>
                                        
                                        <th>E-mail</th>
                                        <th>Телефон</th>
                                        <th>Пароль</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                        <tr> 
                                            <?php if ($val['tel'] == $_SESSION['account']['id']): ?>
                                            <td>
                                                <?php if ($val['status'] == 0): ?>
                                                    Неверифицирован
                                                <?php else: ?>
                                                    Верифицирован
                                                <?php endif; ?>
                                            </td>
                                             
                                            <td><?php echo $val['login']; ?></td>
                                             
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
                                                <?php if ($val['status'] == 0): ?>
                                                <td><?php echo $val['password']; ?>  </td>
                                                <?php else: ?>
                                                    <td>    Недоступно</td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>