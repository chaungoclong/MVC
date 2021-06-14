<div class="container">
    <a class="btn btn-success mb-2"href="<?= WEB_PATH . '/class/new' ?>">NEW</a>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($list_class as $class): ?>
                <tr>
                    <td><?= $class->get_class_id() ?></td>
                    <td><?= $class->get_class_name() ?></td>
                    <td><a href="<?= WEB_PATH . '/class/edit/' . $class->get_class_id() ?>">edit</a></td>
                    <td><a href="<?= WEB_PATH . '/class/delete/' . $class->get_class_id() ?>">delete</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>