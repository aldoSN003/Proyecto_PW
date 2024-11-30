
<main class="container p-4">
        <div class="row">
            <div class="col-md-4">
                <!-- MESSAGES -->
                <?php if (isset($_SESSION['user']['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['user']['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['user']['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php session_unset(); } ?>

                <!-- ADD TASK FORM -->
                <div class="card card-body">
                    <form action="crud_operations/save_task.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" rows="2" class="form-control" placeholder="Task Description" required></textarea>
                        </div>
                        <button type="submit" name="save_task" class="btn btn-success w-100">Save Task</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM task";
                        $result_tasks = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <a href="crud_operations/edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="crud_operations/delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>