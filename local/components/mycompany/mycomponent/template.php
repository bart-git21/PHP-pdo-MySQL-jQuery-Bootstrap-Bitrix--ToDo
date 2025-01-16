<div>
    <h1>List of tasks</h1>
    <?php if (!empty($arResult["ERROR"])): ?>
        <p style="color: red;"><?php echo $arResult["ERROR"]; ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($arResult["TASKS"] as $task): ?>
                <li>
                    <?php echo htmlspecialchars($task["task"]) ?>
                    <button><?php echo $task["is_completed"] ? "Again to do" : "Done" ?></button>
                    <button>Delete</button>
                </li>
            <?php endforeach; ?>
        </ul>
        <h1><?php echo $arResult["MESSAGE"]; ?></h1>
    <?php endif; ?>
</div>