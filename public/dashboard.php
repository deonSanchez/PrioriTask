<?php include 'templates/base.php'; ?>
<?php include 'templates/require_login.php'; ?>

<?php
$sid = $session->sid;
$uid = $session->getUID($sid);
$tasks = $session->getTasks($uid);
$has_tasks = count($tasks) > 0;
?>

<?php startblock('content') ?>
<h1>Dashboard</h1>

<div class="card-list">
<?php if ($has_tasks) { ?>

        <!-- Button trigger modal -->
        <div class="add-card-button mb-3">
            <div class="col row">
                <button type="button" class="btn btn-primary mx-auto" data-toggle="modal" data-target="#taskModal">
    <?= ($has_tasks ? 'Add a new task' : 'Add a task') ?>
                </button>
            </div>
        </div>

    <?php
    include 'templates/card.php';
    foreach (array_reverse($tasks) as $task) {
        renderTask($task);
    }
    ?>

    <?php } else { ?>
        <h5 class="getting-started pb-4">Looks like you don't have any task cards yet!  Click the 'Add a task' button to get started!</h5>
    <?php } ?>
</div>

    <?php if (!$has_tasks) { ?>
    <div class="add-card-button">
        <div class="col row">
            <a href="edit_task.php" class="btn btn-primary mx-auto"><?= ($has_tasks ? 'Add a new task' : 'Add a task') ?></a>
        </div>
    </div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Task successfully added!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="task">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New task:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="taskTitle">Title</label>
                        <input type="text" class="form-control" id="taskTitle" aria-describedby="titleHelp" placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">The title for your task.</small>
                    </div>
                    <div class="form-group">
                        <label for="taskDueDate">Due date</label>
                        <input type="datetime-local" class="form-control" id="taskDueDate">
                    </div>
                    <div class="form-group">
                        <label for="taskEstDays">Est. days to complete:</label>
                        <input type="number" class="form-control" id="taskEstDays">
                    </div>
                    <div class="form-group">
                        <label for="taskEstHours">Est. hours to complete:</label>
                        <input type="number" class="form-control" id="taskEstHours">
                    </div>
                    <div class="form-group">
                        <label for="taskEstMinutes">Est. minutes to complete:</label>
                        <input type="number" class="form-control" id="taskEstMinutes">
                    </div>
                    <div class="form-group">
                        <label for="taskLocation">Location</label>
                        <input type="text" class="form-control" id="taskLocation">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Add an optional image for this task.</small>
                    </div>
                    <div class="form-group">
                        <label for="taskNotes">Notes</label>
                        <textarea class="form-control" id="taskNotes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endblock() ?>

<?php startblock('footer_js') ?>
<script type="text/javascript">
    (function ($) {
        $('form#task').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var task = form.find('input#taskTitle').val();
            var due = form.find('input#taskDueDate').val();
            var datetc = form.find('input#taskEstDays').val();
            var hourtc = form.find('input#taskEstHours').val();
            var minutetc = form.find('input#taskEstMinutes').val();
            var location = form.find('input#taskLocation').val();
            var notes = form.find('textarea#taskNotes').val();

            $.ajax({
                type: 'POST',
                data: 'request=addTask&task=' + task + '&due='
                        + due + '&datetc=' + datetc + '&hourtc=' + hourtc + '&minutetc='
                        + minutetc + '&location=' + location + '&notes=' + notes,
                url: '<?php echo API_URL ?>' + 'index.php',
                async: true,
                success: function (data) {
                    //success
                    if (data == 1) {
                        $('#taskModal').modal('hide');
                        $('#confirmationModal').modal('show');
                    } else {
                        debugger;
                    }
                },
                error: function () {
                    alert("an error has occured!");
                }
            });
        });

        $('#confirmationModal').on('hidden.bs.modal', function (e) {
            // Refresh the page for now. TODO: implement dynamic reloading of task list.
            location.reload();
        })
    })(jQuery)
</script>
<?php endblock() ?>