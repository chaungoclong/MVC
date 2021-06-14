<form action="<?= WEB_PATH . '/class/update' ?>" method="post">
    <input type="hidden" name="class_id" value="<?= $class->get_class_id() ?>">
    <input type="text" name="class_name" value="<?= $class->get_class_name() ?>">
    <button type="submit">save</button>
</form>