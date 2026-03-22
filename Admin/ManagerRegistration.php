<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Manager Registration | RapidMeals Admin</title>
</head>
<body>
<?php
ob_start();
include("Head.php");
include("../Asset/Connection/Connection.php");

$editId = "";
$name = "";
$contact = "";
$email = "";
$address = "";
$gender = "";
$districtId = "";
$placeId = "";
$managerPassword = "";
$alert = "";

if(isset($_POST["btn_submit"])) {
    $editId = trim($_POST["txtid"]);
    $name = trim($_POST["txt_name"]);
    $contact = trim($_POST["txt_contact"]);
    $email = trim($_POST["txt_email"]);
    $address = trim($_POST["txt_Address"]);
    $gender = $_POST["gender"] ?? '';
    $districtId = $_POST["list_district"];
    $placeId = $_POST["list_place"];
    $password = trim($_POST["txt_password"]);
    $photo = $_FILES["file_photo"]["name"];
    $proof = $_FILES["file_proof"]["name"];

    if($photo) {
        $tempPhoto = $_FILES["file_photo"]["tmp_name"];
        move_uploaded_file($tempPhoto, "../Asset/Files/UserPhoto/" . $photo);
    }
    if($proof) {
        $tempProof = $_FILES["file_proof"]["tmp_name"];
        move_uploaded_file($tempProof, "../Asset/Files/UserProof/" . $proof);
    }

    if($editId != "") {
        $updateSql = "update tbl_manager set manager_name='".$name."', manager_contact='".$contact."', manager_email='".$email."', manager_address='".$address."', manager_gender='".$gender."', place_id='".$placeId."', district_id='".$districtId."', manager_password='".$password."'";
        if($photo) $updateSql .= ", manager_photo='".$photo."'";
        if($proof) $updateSql .= ", manager_proof='".$proof."'";
        $updateSql .= " where manager_id='".$editId."'";

        if($con->query($updateSql)) {
            $alert = "<div class='alert alert-success'>Manager updated successfully.</div>";
            header("Location:ManagerRegistration.php");
            exit;
        } else {
            $alert = "<div class='alert alert-danger'>Update failed.</div>";
        }
    } else {
        $insQry = "insert into tbl_manager(manager_name,manager_contact,manager_email,manager_address,manager_gender,place_id,district_id,manager_photo,manager_proof,manager_password)values('".$name."','".$contact."','".$email."','".$address."','".$gender."','".$placeId."','".$districtId."','".$photo."','".$proof."','".$password."')";
        if($con->query($insQry)) {
            $alert = "<div class='alert alert-success'>Manager registered successfully.</div>";
        } else {
            $alert = "<div class='alert alert-danger'>Insertion failed.</div>";
        }
    }
}

if(isset($_GET["did"])) {
    $delQry = "delete from tbl_manager where manager_id='" . $_GET["did"] . "'";
    if($con->query($delQry)) {
        header("Location:ManagerRegistration.php");
        exit;
    } else {
        $alert = "<div class='alert alert-danger'>Deletion failed.</div>";
    }
}

if(isset($_GET["eid"])) {
    $editId = $_GET["eid"];
    $sel = "select * from tbl_manager where manager_id='".$editId."'";
    $result = $con->query($sel);
    if($row = $result->fetch_assoc()) {
        $name = $row['manager_name'];
        $contact = $row['manager_contact'];
        $email = $row['manager_email'];
        $address = $row['manager_address'];
        $gender = $row['manager_gender'];
        $districtId = $row['district_id'];
        $placeId = $row['place_id'];
    }
}

?>
<div class="container mt-5">
  <div class="row g-4">
    <div class="col-lg-5">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0"><?php echo $editId ? 'Edit Manager' : 'Register New Manager'; ?></h5>
        </div>
        <div class="card-body">
          <?php echo $alert; ?>
          <form name="form1" method="post" action="" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="txtid" value="<?php echo $editId ?>" />
            <div class="col-12">
              <label class="form-label">Name</label>
              <input type="text" name="txt_name" class="form-control" value="<?php echo htmlspecialchars($name) ?>" required pattern="^[A-Z][a-zA-Z ]*$" title="Name with first capital letter" />
            </div>
            <div class="col-12">
              <label class="form-label">Contact</label>
              <input type="tel" name="txt_contact" class="form-control" value="<?php echo htmlspecialchars($contact) ?>" required pattern="[6-9][0-9]{9}" title="Phone number starting 6-9" />
            </div>
            <div class="col-12">
              <label class="form-label">Email</label>
              <input type="email" name="txt_email" class="form-control" value="<?php echo htmlspecialchars($email) ?>" required />
            </div>
            <div class="col-12">
              <label class="form-label">Address</label>
              <input type="text" name="txt_Address" class="form-control" value="<?php echo htmlspecialchars($address) ?>" required />
            </div>
            <div class="col-12">
              <label class="form-label d-block">Gender</label>
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="gender" id="genderM" value="M" <?php echo $gender=='M' ? 'checked' : '' ?> required>
                <label class="btn btn-outline-primary" for="genderM">Male</label>

                <input type="radio" class="btn-check" name="gender" id="genderF" value="F" <?php echo $gender=='F' ? 'checked' : '' ?> required>
                <label class="btn btn-outline-primary" for="genderF">Female</label>

                <input type="radio" class="btn-check" name="gender" id="genderO" value="O" <?php echo $gender=='O' ? 'checked' : '' ?> required>
                <label class="btn btn-outline-primary" for="genderO">Other</label>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">District</label>
              <select name="list_district" id="list_district" class="form-select" onchange="getPlace(this.value)" required>
                <option value="">Select District...</option>
                <?php
                $seldis="select * from tbl_district";
                $rowdis=$con->query($seldis);
                while($datadis=$rowdis->fetch_assoc()) {
                  echo '<option value="'.$datadis['district_id'].'"'.($datadis['district_id']==$districtId ? ' selected' : '').'>'.$datadis['district_name'].'</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Place</label>
              <select name="list_place" id="txt_place" class="form-select" required>
                <option value="">Select Place...</option>
                <?php
                if($districtId) {
                  $selplace="select * from tbl_place where district_id='".$districtId."'";
                  $rowplace=$con->query($selplace);
                  while($dataplace=$rowplace->fetch_assoc()) {
                    echo '<option value="'.$dataplace['place_id'].'"'.($dataplace['place_id']==$placeId ? ' selected' : '').'>'.$dataplace['place_name'].'</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Photo</label>
              <input type="file" name="file_photo" class="form-control" <?php echo $editId ? '' : 'required' ?> />
            </div>
            <div class="col-md-6">
              <label class="form-label">Proof</label>
              <input type="file" name="file_proof" class="form-control" <?php echo $editId ? '' : 'required' ?> />
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="txt_password" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="txt_cpassword" class="form-control" required />
            </div>
            <div class="col-12 text-end mt-2">
              <button type="submit" name="btn_submit" class="btn btn-primary"><?php echo $editId ? 'Update Manager' : 'Submit'; ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Registered Managers</h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered mb-0 align-middle">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $selMgr = "select * from tbl_manager order by manager_id desc";
                $mgrRes = $con->query($selMgr);
                $counter = 0;
                if($mgrRes->num_rows > 0) {
                  while($mgr = $mgrRes->fetch_assoc()) {
                    $counter++;
                    echo '<tr>';
                    echo '<td>'.$counter.'</td>';
                    echo '<td>'.htmlspecialchars($mgr['manager_name']).'</td>';
                    echo '<td>'.htmlspecialchars($mgr['manager_email']).'</td>';
                    echo '<td>'.htmlspecialchars($mgr['manager_contact']).'</td>';
                    echo '<td class="text-center">';
                    echo '<a class="btn btn-sm btn-info me-1" href="ManagerRegistration.php?eid='.$mgr['manager_id'].'">Edit</a>';
                    echo '<a class="btn btn-sm btn-danger" href="ManagerRegistration.php?did='.$mgr['manager_id'].'" onclick="return confirm(\'Delete manager?\');">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                  }
                } else {
                  echo '<tr><td colspan="5" class="text-center text-muted py-4">No managers registered yet.</td></tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../Asset/JQuery/jQuery.js"></script>
<script>
function getPlace(did) {
if(did == '') {
$('#txt_place').html('<option value="">Select Place...</option>');
return;
}
$.ajax({
url: "../Asset/AjaxPages/AjaxPlace.php?pid="+did,
success: function(html) {
$("#txt_place").html(html);
}
});
}
</script>

<?php
include("Foot.php");
ob_flush();
?>
</body>
</html>
