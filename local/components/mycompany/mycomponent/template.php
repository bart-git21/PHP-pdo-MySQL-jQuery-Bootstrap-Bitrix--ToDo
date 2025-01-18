<div>
    <h1>List of tasks</h1>
    <?php if (!empty($arResult["ERROR"])): ?>
        <p style="color: red;"><?php echo $arResult["ERROR"]; ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($arResult["TASKS"] as $task): ?>
                <li>
                    <?php echo htmlspecialchars($task["task"]) ?>
                    <button id="toggleBtn" data-action="toggle"
                        data-task-id="<?php echo $task['id']; ?>"><?php echo $task["is_completed"] ? "To do again" : "Done" ?></button>
                    <button id="deleteBtn" data-action="delete" data-task-id="<?php echo $task['id']; ?>">Delete</button>
                </li>
            <?php endforeach; ?>
        </ul>
        <h1><?php echo $arResult["MESSAGE"]; ?></h1>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $("#toggleBtn").on("click", function () {
            const taskId = $(this).data('task-id');

            $.ajax({
                url: "/ajax.php",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { id: taskId, action: toggle_task },
                beforeSend: function () {
                    $(this).prop('disabled', true);
                },
            })
                .done(response => response.success && location.reload();)
                .fail((xhr, status, error) => console.error("Error: ", error))
                .always(() => $(this).prop("disabled", false))
        })

        $('#deleteBtn').on("click", function () {
            const taskId = $(this).data("task-id");

            $.ajax({
                url: "/ajax.php",
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { id: taskId, action: delete_task },
                beforeSend: function () {
                    $(this).prop("disabled", true);
                },
            })
                .done(response => response.succes && location.reload())
                .fail((xhr, status, error) => console.error("Error: ", error))
                .always(() => $(this).ptop("disabled", false))
        })
    })
</script>