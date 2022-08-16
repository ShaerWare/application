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
                                        <th>Заявка на статус Агента</th>
                                        <th>Рефералов</th>
                                        <th>Логин</th>
                                        <th>ФИО</th>
                                        <th>E-mail</th>
                                        <th>Телефон</th>
                                        <th>Паспорт: серия, номер, дата выдачи, кем выдан, код подразделения</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                        <?php if ($val['agent'] == 1): ?>
                                        <tr>
                                            <td>                                                
                                                <form action="/admin/zapros" method="post">
                                                    <input name="id"  type="hidden" class="form-control" value="<?php echo $val['id']; ?>" >
                                                        <select name="agent">
                                                            <option  value="5">Отменить заявку</option>
                                                            <option  value="2">Одобрить заявку агента</option>
                                                            <option  value="4">Забанить</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary" >ТЫК</button>
                                                </form>
                                            </td>
                                            <td><?php echo $val['ref']; ?></td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['family']; ?> <?php echo $val['name']; ?> <?php echo $val['name2']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
                                            <td><?php echo $val['ser']; ?> <?php echo $val['nomer']; ?> <?php echo $val['data']; ?> <?php echo $val['vidan']; ?> <?php echo $val['kod']; ?></td>
                                        <?php endif; ?>
                                        </tr>
                                        <?php if ($val['agent'] == 3): ?>
                                        <tr>
                                            <td>                                                
                                                <form action="/admin/zapros" method="post">
                                                    <p>Получена заявка на отмену статуса Агента</p>
                                                    <input name="id"  type="hidden" class="form-control" value="<?php echo $val['id']; ?>" >
                                                        <select name="agent">
                                                            <option name="agent" value="2">Отменить заявку</option>
                                                            <option name="agent" value="5">Сделать обычным пользователем</option>
                                                            <option name="agent" value="4">Забанить</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary" >ТЫК</button>
                                                </form>
                                            </td>
                                            <td><?php echo $val['ref']; ?></td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['family']; ?> <?php echo $val['name']; ?> <?php echo $val['name2']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
                                            <td><?php echo $val['ser']; ?> <?php echo $val['nomer']; ?> <?php echo $val['data']; ?> <?php echo $val['vidan']; ?> <?php echo $val['kod']; ?></td>
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