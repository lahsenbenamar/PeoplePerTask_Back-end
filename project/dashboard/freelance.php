<?php
	include('./include/adminsession.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php

$place = '';
?>
<?php include('include/head.php') ?>
<?php include('include/connect.php') ?>

<body>
    <div class="wrapper">
        <?php include('include/aside.php') ?>
        <div class="main">
            <?php include('include/navbar.php') ?>
            <a href="create/addfreelance.php" class="btn btn-primary" ">
                ADD FREELANCE
            </a>
            <div class=" Agents">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FreelanceName</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Skills</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php



                        $sql = "SELECT * FROM users where ROLE = 'freelance' ";
                        $user = mysqli_query($con, $sql);

                        if (!$user) {
                            die("invaled query: " . mysqli_error($con));
                        }

                        while ($row = mysqli_fetch_assoc($user)) {
                        ?>
                            <tr>
                                <td><?= $row['ID_user'] ?></td>
                                <td><?= $row['user_name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['userPassword'] ?></td>
                                <td><?php 
                                $sql = "SELECT * FROM freelance_skills LEFT JOIN skills ON freelance_skills.skills_id = skills.id WHERE freelance_skills.freelance_id = $row[ID_user]";
                                $result = mysqli_query($con,$sql);
                                while ($skill = mysqli_fetch_assoc($result)) {
                                    echo $skill['name'].",";
                                }
                                ?></td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='edit/editfreelance.php?id=<?= $row['ID_user'] ?>'>Edit</a>
                                    <button class='btn btn-danger btn-sm' onclick="deleteRow('<?= $row['ID_user'] ?>','users')">Delete</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>FreelanceName</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Skills</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="js/agents.js"></script>
    <script src="./js/ajax.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>