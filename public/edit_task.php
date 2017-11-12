<?php include 'templates/header.php'; ?>

<h1>Editing task: <span id="task-name">New Task</span></h1>

<div class="task-form">
	<div class="prioritask-padding">
		Title: <input type="text" name="title" value="Paper Prototype">
	</div>
	<div>
		Due: <input type="datetime-local" name="estTimeToComplete">
	</div>
	<div>
		Estimated Time to Complete:
		Days <input type="number" name="day" value="7">
		Hours <input type="number" name="hour" value="2" max="24">
		Minutes <input type="number" name="minutes" value="30" max="60">
	</div>
	<div>
		Location: <input type="text" name="Location" value="">
	</div>
	<div>
		Add Image:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload Image" name="submit">
	</div>
	<div>
		Notes: <input type="text" name="Notes" value="Remind Partners to pull weight">
	</div>
</div>

<div class="row">
	<button type="button" class="prioritask-spaced btn btn-primary col-md">Add</button>
	<a class="btn btn-secondary col-md" href="/dashboard.php">Cancel</a>
</div>

<?php include 'templates/footer.php'; ?>