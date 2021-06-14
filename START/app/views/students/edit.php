<form action="<?= WEB_PATH . '/student/update' ?>" method="post">
    <input type="hidden" name="student_id" value="<?= $student->get_student_id() ?>">
    <input type="text" name="student_name" value="<?= $student->get_student_name() ?>">
    <br>
    <input type="radio" name="student_gender" value="1" <?= ($student->get_student_gender() == 1) ? "checked" : "" ?>>
    <input type="radio" name="student_gender" value="0" <?= ($student->get_student_gender() == 0) ? "checked" : "" ?>>
    <br>
  
    <select name="student_class">
        <?php foreach ($list_class as $class): ?>
            <option value="<?= $class->get_class_id() ?>" 
            <?= $class->get_class_id() == $student->get_student_class()->get_class_id() ? "selected" : "" ?>>
                <?= $class->get_class_name() ?>
            </option>
        <?php endforeach ?>
    </select>
    <button type="submit">SAVE</button>
</form>