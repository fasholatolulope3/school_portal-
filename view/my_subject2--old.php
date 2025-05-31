<?php
if(!isset($_SERVER['HTTP_REFERER'])){
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
	overflow-y:scroll;
}
.modal-content1 {
   position: absolute;
   left: 125px; 
}
@media only screen and (max-width: 500px) {

	.modal-content1 {
   		
		position:static;
   
	}
}

.form-control-feedback {
  
   pointer-events: auto;
  
}

.set-width-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
}
.set-color-tooltip + .tooltip > .tooltip-inner { 
  
     min-width:180px;
	 background-color:red;
}

.msk-fade{  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* Make modal body scrollable if content is too tall */
.modal-body {
    max-height: 70vh;
    overflow-y: auto;
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
	<section class="content" > <!-- Start of table section -->
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

                                <!-- modal-header -->
                              
                            <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="subjectModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="subjectModalLabel">Choose an Action</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul style="list-style:none; padding-left:0;">
                                                <li><button class="btn btn-primary btn-block" id="postAssignmentBtn">Post Assignment</button></li>
                                                <li><button class="btn btn-primary btn-block" id="receiveAssignmentBtn">Receive Assignment</button></li>
                                                <li><button class="btn btn-primary btn-block" id="postContentBtn">Post Content</button></li>
                                                <li><button class="btn btn-primary btn-block" id="giveQuizBtn">Give Quiz</button></li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                            </div>
                        <!-- End Modal -->
                       <!-- Post Assignment Modal -->
<div class="modal fade" id="postAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="postAssignmentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="postAssignmentModalLabel">Post Assignment</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                            <div class="form-group">
                                <label for="assignmentTitle">Assignment Title</label>
                                <input type="text" class="form-control" id="assignmentTitle" name="assignmentTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="assignmentDescription">Assignment Description</label>
                                <textarea class="form-control" id="assignmentDescription" name="assignmentDescription" rows="3" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Receive Assignment Modal -->
<div class="modal fade" id="receiveAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="receiveAssignmentModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="receiveAssignmentModalLabel">Receive Assignment</h4>
      </div>
        <div class="modal-body">
          
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Post Content Modal -->
<div class="modal fade" id="postContentModal" tabindex="-1" role="dialog" aria-labelledby="postContentModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="postContentModalLabel">Post Content</h4>
      </div>
      <div class="modal-body">
       <form action="#" method="POST">
                            <div class="form-group">
                                <label for="postContent">Content Title</label>
                                <input type="text" class="form-control" id="postContent" name="contentTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="contentDescription">Content Description</label>
                                <textarea class="form-control" id="assignmentDescription" name="assignmentDescription" rows="3" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                </form>
      </div>
    </div>
  </div>
</div>


<!-- Give Quiz Modal -->
<div class="modal fade" id="giveQuizModal" tabindex="-1" role="dialog" aria-labelledby="giveQuizModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="giveQuizModalLabel">Give Quiz</h4>
            </div>
            <div class="modal-body">
                
<form id="quizForm" action="submit_quiz.php" method="POST">
    <div class="form-group">
        <label for="quizTitle">Quiz Title</label>
        <input type="text" class="form-control" id="quizTitle" name="quizTitle" required>
    </div>
    <div class="form-group">
        <label for="numQuestions">Number of Questions (1-20)</label>
        <input type="number" class="form-control" id="numQuestions" name="numQuestions" min="1" max="20" required>
        <button type="button" id="generateQuestionsBtn" class="btn btn-info" style="margin-top:10px;">Generate Questions</button>
    </div>
    <div id="questionsContainer">
        <!-- Questions will be generated here -->
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit Quiz</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>

<!-- End of Give Quiz Modal -->
<script>
$(document).ready(function(){
    function generateQuestions() {
        var num = parseInt($('#numQuestions').val());
        var container = $('#questionsContainer');
        container.empty();
        if (num > 0 && num <= 20) {
            for (var i = 1; i <= num; i++) {
                container.append(`
                  <div class="quiz-question-block" style="border:1px solid #eee; padding:10px; margin-bottom:10px;">
                    <h5>Question ${i}</h5>
                    <div class="form-group">
                      <label>Question</label>
                      <input type="text" class="form-control" name="questions[${i}][question]" required>
                    </div>
                    <div class="form-group">
                      <label>Options</label>
                      <input type="text" class="form-control" name="questions[${i}][option1]" placeholder="Option 1" required>
                      <input type="text" class="form-control" name="questions[${i}][option2]" placeholder="Option 2" required>
                      <input type="text" class="form-control" name="questions[${i}][option3]" placeholder="Option 3" required>
                    </div>
                    <div class="form-group">
                      <label>Correct Option</label>
                      <select class="form-control" name="questions[${i}][correct]" required>
                        <option value="">Select Correct Option</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                      </select>
                    </div>
                  </div>
                `);
            }
        }
    }

    // Only generate questions when the button is clicked
    $('#generateQuestionsBtn').on('click', generateQuestions);

    $('#quizForm').on('submit', function(e){
        console.log($(this).html());
        if ($('#questionsContainer').children().length === 0) {
            alert('Please enter the number of questions and click "Generate Questions" before submitting.');
            e.preventDefault();
            return false;
        }
    });
});
</script>
<!-- End of Give Quiz Modal -->

<?php
include_once('../controller/config.php');

$index=$_SESSION["index_number"];

$sql1="SELECT * FROM teacher WHERE index_number='$index'";
$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_assoc($result1);
$id=$row1['id'];

$sql="select grade.name as g_name,subject.name as s_name,subject_routing.id as sr_id,subject_routing.fee as s_fee
      from subject_routing
      inner join grade
      on subject_routing.grade_id=grade.id 
      inner join subject
      on subject_routing.subject_id=subject.id 
      where subject_routing.teacher_id='$id'";
$result=mysqli_query($conn,$sql);
if (!$result) {
    echo "<div style='color:red;'>SQL Error: " . mysqli_error($conn) . "</div>";
}
$count = 0;
if(mysqli_num_rows($result) > 0) {
    while($row=mysqli_fetch_assoc($result)){
        $count++;
?>   
                                <tr>
                                    <td><?php echo $count; ?></td>
               						<td><?php echo $row['g_name']; ?></td>
               						<td class="subject-cell" style="cursor: pointer; color: #40b9d7;"><?php echo $row['s_name']; ?></td>
               						<td><?php echo $row['s_fee']; ?></td>
                            	</tr>
<?php } } else { echo "<div style='color:red;'>No subjects found for this teacher.</div>"; } ?>
                        	</tbody>
                    	</table>
                	</div><!-- ./box-body -->
            	</div><!-- ./box -->
        	</div> 
    	</div><!-- ./row -->
	</section> <!-- End of table section --> 
    
<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("../index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>
    <script>
$(document).ready(function(){
    // When a subject cell is clicked, show the modal
    $('.subject-cell').on('click', function(){
        $('#subjectModal').modal('show');
    });
    $('#postAssignmentBtn').on('click', function(){
        $('#subjectModal').modal('hide');
        $('#postAssignmentModal').modal('show');
    });
    $('#receiveAssignmentBtn').on('click', function(){
        $('#subjectModal').modal('hide');
        $('#receiveAssignmentModal').modal('show');
    });
    $('#postContentBtn').on('click', function(){
        $('#subjectModal').modal('hide');
        $('#postContentModal').modal('show');
    });
    $('#giveQuizBtn').on('click', function(){
        $('#subjectModal').modal('hide');
        $('#giveQuizModal').modal('show');
        // Move focus to the quiz title input as soon as the modal is shown
        $('#giveQuizModal').on('shown.bs.modal', function () {
            $('#quizTitle').focus();
            // Remove this handler after it runs once
            $('#giveQuizModal').off('shown.bs.modal');
        });
    });
});
</script>

  	 	
</div><!-- /.content-wrapper -->  
<?php include_once('footer.php');?>

                         
<?php include_once('footer.php');?>