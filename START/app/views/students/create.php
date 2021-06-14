<form action="<?= WEB_PATH . '/student/store'?>" method="post">
    <input type="text" name="student_name">
    <br>
    <input type="radio" name="student_gender" value="1"> Nam
    <input type="radio" name="student_gender" value="0"> Nu

    <select name="student_class">
        <?php foreach($list_class as $class): ?>
            <option value="<?= $class->get_class_id() ?>"><?= $class->get_class_name() ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">CREATE</button>
</form>