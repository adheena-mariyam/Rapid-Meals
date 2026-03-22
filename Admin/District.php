<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RapidMeals : District</title>
</head>
<body>
<?php
include("../Asset/Connection/Connection.php");
ob_start();
include("Head.php");

if(isset($_POST["btnsave"]))
{
$district=$_POST["txtdis"];
$hid=$_POST["txtid"];
if($hid!="")
{
$upQry="update tbl_district set district_name='".$district."' where district_id='".$hid."'";
if($con->query($upQry))
{
header("Location:district.php");
}
}
else
{
$insqry="insert into tbl_district(district_name)values('".$district."')";
if($con->query($insqry))
{
echo '<div class="alert alert-success m-3">District added successfully</div>';
}
else
{
echo '<div class="alert alert-danger m-3">Failed to insert district</div>';
}
}
}

if(isset($_GET["did"]))
{
$delQry="delete from tbl_district where district_id='".$_GET["did"]."'";
if($con->query($delQry))
{
header("Location:district.php");
}
else
{
echo '<div class="alert alert-danger m-3">Deletion failed</div>';
}
}

$did="";
$dname="";
if(isset($_GET["eid"]))
{
$selqry1="select * from tbl_district where district_id='".$_GET["eid"]."'";
$row1=$con->query($selqry1);
$data1=$row1->fetch_assoc();
$did=$data1["district_id"];
$dname=$data1["district_name"];
}
?>

<div class="container mt-5">
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">District Management (Admin)</h4>
    </div>
    <div class="card-body">
      <form id="form1" name="form1" method="post" action="district.php" class="row g-3">
        <input type="hidden" name="txtid" value="<?php echo $did?>" />
        <div class="col-md-9">
          <label for="txtdis" class="form-label">District Name</label>
          <input type="text" name="txtdis" id="txtdis" class="form-control" value="<?php echo $dname?>" autocomplete="off" required title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z][a-zA-Z ]*$" />
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2">
          <button type="submit" name="btnsave" class="btn btn-success">Save</button>
          <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-header bg-light">
      <h5 class="mb-0">Existing Districts</h5>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width: 5%;">#</th>
              <th>District</th>
              <th style="width: 25%;" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $selqry="select * from tbl_district";
            $result=$con->query($selqry);
            $i=0;
            while($data=$result->fetch_assoc())
            {
              $i++;
            ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo htmlspecialchars($data["district_name"]) ?></td>
              <td class="text-end">
                <a class="btn btn-sm btn-warning" href="district.php?eid=<?php echo $data["district_id"]?>">Edit</a>
                <a class="btn btn-sm btn-danger" href="district.php?did=<?php echo $data["district_id"]?>" onclick="return confirm('Do you want to delete this district?');">Delete</a>
              </td>
            </tr>
            <?php
            }
            if($i==0):
            ?>
            <tr>
              <td colspan="3" class="text-center text-muted py-4">No districts found. Use the form above to add your first district.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-muted">
      Total districts: <?php echo $i; ?>
    </div>
  </div>
</div>

<?php
include("Foot.php");
ob_flush();
?>
</body>
</html>
