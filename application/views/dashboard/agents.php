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
                                        <th>Рефералов</th>
                                        <th>Логин</th>
                                        <th>E-mail</th>
                                        <th>Кошелек</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                        <tr>
                                            <td><?php echo $val['ref']; ?></td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
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