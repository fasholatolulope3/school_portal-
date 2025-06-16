<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header_teacher.php'); ?>
<?php include_once('sidebar2.php'); ?>

<style>
    body {
        overflow-y: scroll;
    }

    .modal-content1 {
        position: absolute;
        left: 125px;
    }

    @media only screen and (max-width: 500px) {

        .modal-content1 {

            position: static;

        }
    }

    .form-control-feedback {

        pointer-events: auto;

    }

    .set-width-tooltip+.tooltip>.tooltip-inner {

        min-width: 180px;
    }

    .set-color-tooltip+.tooltip>.tooltip-inner {

        min-width: 180px;
        background-color: red;
    }

    .msk-fade {

        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    .set-color {
        color: #0074D9;
    }

    .set-color-tooltip+.tooltip>.tooltip-inner {
        min-width: 180px;
        background-color: #0074D9;
        color: #fff;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Subject
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subject</a></li>
            <li><a href="#">My Subject</a></li>
        </ol>
    </section>

    <!-- table for view all records -->
    <section class="content"> <!-- Start of table section -->
        <div class="row" id="table1"><!--MSK-000132-1-->
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title">My Subject</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <!-- MSK-00093-->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th class="col-md-1">ID</th>
                                <th class="col-md-1">Grade</th>
                                <th class="col-md-1">Subject</th>
                                <th class="col-md-1">Fee($)</th>
                            </thead>
                            <tbody>
                                <?php
                                include_once('../controller/config.php');

                                $index = $_SESSION["index_number"];

                                $sql1 = "SELECT * FROM teacher WHERE index_number='$index'";
                                $result1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                                $id = (isset($row1) && isset($row1['id'])) ? $row1['id'] : '';


                                $sql = "select grade.name as g_name,subject.name as s_name,subject_routing.id as sr_id,subject_routing.fee as s_fee
	  from subject_routing
	  inner join grade
      on subject_routing.grade_id=grade.id 
      inner join subject
      on subject_routing.subject_id=subject.id 
	  where subject_routing.teacher_id='$id'";
                                $result = mysqli_query($conn, $sql);
                                $count = 0;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $count++;
                                ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['g_name']; ?></td>
                                            <td>
                                                <a href="#"
                                                    class="set-color set-color-tooltip subject-action-link"
                                                    data-toggle="tooltip"
                                                    title="Click to view subject actions"
                                                    data-srid="<?php echo $row['sr_id']; ?>">
                                                    <!-- #region --> <?php echo $row['s_name']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $row['s_fee']; ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div><!-- ./box-body -->
                </div><!-- ./box -->
            </div>
        </div><!-- ./row -->
    </section> <!-- End of table section -->

    <!-- ------- subject action model  starts------------>

    <div class="modal fade" id="subjectActionModal" tabindex="-1" role="dialog" aria-labelledby="subjectActionModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#0074D9;color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="subjectActionModalLabel">Subject Actions</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="subject-action-links">
                        <li class="list-group-item"><a href="./post_content.php" id="postContentLink">Post Content</a></li>
                        <li class="list-group-item"><a href="./set_quiz.php" id="setQuizLink">Set Quiz</a></li>
                        <li class="list-group-item"><a href="#" id="viewManageResultLink">View and Manage Result</a></li>
                        <li class="list-group-item"><a href="#" id="recordLink">Records</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('.subject-action-link').on('click', function(e) {
                e.preventDefault();
                var srid = $(this).data('srid');
                $('#postContentLink').attr('href', 'post_content.php?subject_id=' + srid);
                $('#setQuizLink').attr('href', 'set_quiz.php?subject_id=' + srid);
                $('#viewManageResultLink').attr('href', 'view_manage_result.php?subject_id=' + srid);
                $('#recordLink').attr('href', 'record.php?subject_id=' + srid);
                $('#subjectActionModal').modal('show');
            });
        });
    </script>
    <!-- ------- subject action model ends ------------>

    <!--redirect your own url when clicking browser back button -->
    <script>
        (function(window, location) {
            history.replaceState(null, document.title, location.pathname + "#!/history");
            history.pushState(null, document.title, location.pathname);

            window.addEventListener("popstate", function() {
                if (location.hash === "#!/history") {
                    history.replaceState(null, document.title, location.pathname);
                    setTimeout(function() {
                        location.replace("../index.php"); //path to when click back button
                    }, 0);
                }
            }, false);
        }(window, location));
    </script>

</div><!-- /.content-wrapper -->

<?php include_once('footer.php'); ?>