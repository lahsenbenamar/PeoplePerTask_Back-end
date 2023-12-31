
<!DOCTYPE html>
<html lang="en">
<?php
session_start();

$place = '';

?>

<?php
include('include/head.php');
?>

<body>
    <div class="wrapper">
        <?php include('include/aside.php') ?>
        <div class="main">
            <?php include('include/navbar.php') ?>
            <div class="d-flex">
                <a class='btn btn-primary' style="width : 10rem;" href='create/addcategory.php'>ADD CATEDORY</a>
                <a class='btn btn-primary' style="width : 14rem;" href='create/addsub_category.php'>ADD SUB-CATEDORY</a>
            </div>
            <div class="Agents">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Number of project</th>
                            <th>Number of sub_category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include('include/connect.php');
                        $sql = "SELECT categories.id as id_cat,CategoryName,COUNT(DISTINCT projects.id) as projectN,COUNT(DISTINCT sub_categories.id) as categoryN FROM categories
                   left JOIN projects on categories.id = projects.id_categorie
                   left JOIN sub_categories on categories.id = sub_categories.id_category
                   GROUP BY categories.id
                   ";
                        $user = mysqli_query($con, $sql);

                        if (!$user) {
                            die("invaled query: " . mysqli_error($con));
                        }

                        while ($row = mysqli_fetch_assoc($user)) {
                        ?>
                            <tr>
                                <td><?= $row['id_cat'] ?></td>
                                <td><?= $row['CategoryName'] ?></td>
                                <td><?= $row['projectN'] ?></td>
                                <td><?= $row['categoryN'] ?></td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='edit/editcategory.php?id=<?= $row['id_cat'] ?>'>Edit</a>
                                    <button class='btn btn-danger btn-sm' onclick="deleteRow('<?= $row['id_cat'] ?>','categories')">Delete</button>
                                    <a class='btn btn-danger btn-sm' href='delete/delete_sub_cat.php?id=<?= $row['id_cat'] ?>&category=<?= $row['CategoryName'] ?>'>Delete sub category</a>
                                </td>
                            </tr>
                           
                        <?php  }
                        ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Number of project</th>
                            <th>Number of sub_category</th>
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
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>