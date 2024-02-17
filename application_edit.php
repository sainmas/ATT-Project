<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>
    <!-- Load theme from localstorage -->
    <script src="js/themescript.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles/styles.css"/>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
session_start();
$_SESSION['location'] = '';

include '/home/dragonfl/db.php';
$id = $_POST['application-id'];
$sql = "SELECT * FROM `applications` WHERE `application_id` = $id;";

$result = @mysqli_query($cnxn, $sql);

while ($row = mysqli_fetch_assoc($result))
{
    $jname = $row['jname'];
    $ename = $row['ename'];
    $jurl = $row['jurl'];
    $jdescription = $row['jdescription'];
    $adate = $row['adate'];
    $astatus = $row['astatus'];
    $fupdates = $row['fupdates'];
    $followupdate = $row['followupdate'];
}
include 'php/nav_bar.php' ?>
<main>
    <div class="container p-3" id="main-container">
        <h3 class="form-header">Edit Application</h3>
        <div class="form-container">
            <form method="post" action="php/application_update.php" onsubmit="return validateForm()" class="form-body my-3">
                <div class="mb-4">
                    <label for="job-name" class="form-label">Job Name*</label>
                    <input type="text" class="form-control" id="job-name" name="job-name" maxlength="60" required
                        value = "<?php echo $jname?>">
                </div>
                <div class="mb-4">
                    <label for="employer-name" class="form-label">Employer Name*</label>
                    <input type="text" class="form-control" id="employer-name" name="employer-name" maxlength="60"
                           required value = "<?php echo $ename?>">
                </div>
                <div class="mb-4">
                    <label for="job-url" class="form-label">Job Description URL*</label>
                    <input type="text" class="form-control" id="job-url" name="job-url" maxlength="500" required
                           value = "<?php echo $jurl?>">
                </div>
                <div class="mb-4">
                    <label for="job-description" class="form-label">Job Description</label>
                    <textarea class="form-control" id="job-description" name="job-description"
                              placeholder="Little summary of the role of the job..." maxlength="500"
                              rows="3"><?php echo $jdescription?></textarea>
                </div>
                <div class="mb-4">
                    <label for="app-date" class="form-label">Date of Application*</label>
                    <input type="date" class="form-control" id="app-date" name="app-date" required
                           value = <?php echo $adate?>>
                </div>
                <div class="mb-4">
                    <label for="application-status" class="form-label mb-3">Application Status*</label><br>
                    <select name="application-status" id="application-status">
                        <option value="select">Select an option</option>
                        <option value="need-to-apply"
                            <?php if ($astatus == "need-to-apply") {
                                echo"selected";
                            }?>>Need to apply</option>
                        <option value="applied"
                            <?php if ($astatus == "applied") {
                                echo"selected";
                            }?>>Applied</option>
                        <option value="interviewing"
                            <?php if ($astatus == "interviewing") {
                                echo"selected";
                            }?>>Interviewing</option>
                        <option value="rejected"
                            <?php if ($astatus == "rejected") {
                                echo"selected";
                            }?>>Rejected</option>
                        <option value="accepted"
                            <?php if ($astatus == "accepted") {
                                echo"selected";
                            }?>>Accepted</option>
                        <option value="inactive"
                            <?php if ($astatus == "inactive") {
                                echo"selected";
                            }?>>Inactive/Expired</option>
                    </select>
                    <div id="application-wrong" style="color:red"></div>
                </div>
                <div class="mb-4">
                    <label for="follow-updates" class="form-label">Updates</label>
                    <textarea class="form-control" id="follow-updates" name="follow-updates"
                              placeholder="Who have you spoken with or interviewed with?" maxlength="500"
                              rows="3"><?php echo $fupdates?></textarea>
                </div>

                <div class="mb-4">
                    <label for="followup-date" class="form-label">Follow up date*</label>
                    <input type="date" class="form-control" id="followup-date" name="followup-date" required
                           value = <?php echo $followupdate?>>
                </div>

                <input type="hidden" name="application-id" value="<?php echo $id; ?>" />

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</main>


<?php include 'php/footer.php' ?>
<script src="js/main.js"></script>
<!-- Special Javascript to allow special application things work -->
<script src="js/applicationscript.js"></script>
</body>
</html>