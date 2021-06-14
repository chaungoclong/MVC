<div class="container">
    <a href="<?= WEB_PATH . '/student/new' ?>" class="btn btn-success">NEW</a>
</div>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>STUDENT NAME</th>
                <th>STUDENT GENDER</th>
                <th>CLASS NAME</th>
                <th colspan="2">ACTION</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($list_student as $student): ?>
                <tr>
                    <td><?= $student->get_student_id() ?></td>
                    <td><?= $student->get_student_name() ?></td>
                    <td><?= $student->get_student_gender() == 1 ? "Nam" : "Nu" ?>
                    <td><?= $student->get_student_class()->get_class_name() ?></td>
                    <td><a href="<?= WEB_PATH . '/student/edit/' . $student->get_student_id() ?>">EDIT</a></td>
                    <td><a href="<?= WEB_PATH . '/student/delete/' . $student->get_student_id() ?>">DELETE</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</div>