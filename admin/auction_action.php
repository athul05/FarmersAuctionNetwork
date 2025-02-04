<?php
include ("dbconfig.php");
include ("session.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
#a
{
  margin-left:255px;
  background-color:#BEE7EC;
}
#b
{
  margin-top:70px;
  margin-left:20px;
  color:#000000;
}
#c{
  background-color:#B5CFDD;

}
#top{
  margin-top:100px;
}
.profile-container {
  background-color: #cbecd3;
  margin: 0.5em 5em 0.5em;
  padding: 2em;
  display: flex;
  justify-content: space-around;
  border-radius: 0.5em;
  box-shadow: 0 5px 25px 0 rgba(0, 0, 0, 0.25);
}
.profile-container  .profile-items {
    display: flex;
    flex-direction: column;
    word-spacing: 5px;
}

.farmer-avatar{
  max-width: 20%;
  max-height: 20%;
}

#profile-name{
    font-size: 2.5rem;
    font-weight:900;
}

#profile-info{
    font-weight: 600;
}
li{
list-style:none;
}
</style>

</head>
<body>
<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
    <div class="container-fluid">

    <nav class="navbar navbar-expand-xs navbar-dark fixed-top shadow p-3 mb-5" id="a">
          <ul class="navbar-nav ml-auto">
          <button type="button" class="btn btn-sm btn-light">
                <li class="nav-item">
                        <a href="logout.php" class="nav-link font-weight-bold text-dark">Logout</a>
                </li>
          </button>
          </ul>
      </nav>

    <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-2 p-0 flex-shrink-1 shadow p-3" id="c">
            <nav class="navbar navbar-expand  navbar-dark flex-md-column flex-row align-items-start py-2" id="b">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link pl-0  font-weight-bold text-dark" href="admin_index.php"><span class="d-none d-md-inline">Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 font-weight-bold text-dark" href="verify.php"> <span class="d-none d-md-inline">Verification</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 font-weight-bold text-dark" href="auction.php"><span class="d-none d-md-inline">Auction</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 font-weight-bold text-dark" href="farmers.php"> <span class="d-none d-md-inline">Farmers</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 font-weight-bold text-dark" href="retailers.php"><span class="d-none d-md-inline">Retailers</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col bg-faded py-3 flex-grow-1">
        <h1 class="text-dark" id="space" style="margin-left:20px; margin-top:100px;">Auction</h2>
                <div class="row">
                    <div class="col-2"></div>
                        <div class="col-8">
                            <form action="auction_action.php" method="POST" id="top">
                                <div class="form-group">
                                    <label>Choose Date</label>
                                    <input type="date" class="form-control" value="<?php echo $today; ?>" name="date">
                                </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-light btn-white">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="col-2"></div>
<?php
$date=$_POST['date'];
$sql1="SELECT fname,rname,quantity,date,crop,currprize,status from auction,farmer,retailer where auction.date='$date' and auction.fid=farmer.fid and retailer.rid=auction.rid";
$s1=mysqli_query($con,$sql1);
while(($row=mysqli_fetch_array($s1))==TRUE)
{
if($row['status']==0)
$bid_status="Online";
else
$bid_status="Offline";
?>
                    <div class="profile-container" style="margin-top:30px;">
                        <ul class="profile-items">
                        <li style="font-size:large;">Farmer: <span id="profile-info"><?php echo $row['fname'];?></span><span style="margin-left:20px;">Retailer: </span><span id="profile-info"><?php echo $row[1];?></span></li>
                        <li>Crop: <span id="profile-info"><?php echo $row['crop'];?></span></li> 
                        <li>Quantity: <span id="profile-info"><?php echo $row['quantity'];?></span></li>
                        <li>Highest Bid: <span id="profile-info"> ₹ <?php echo $row[5];?></span></li>
                        <li>Date: <span id="profile-info"><?php echo $row['date'];?></span></li>
                        <li>Auction Status: <span id="profile-info"><?php echo $bid_status;?></span></li>
                        </ul>
                <?php
                    if($row['crop']=="wheat"){
                        echo"<img src='wheat.png' class='farmer-avatar'>"; 
                        }
                        else if($row['crop']=="coconut"){
                        echo"<img src='coconut.png' class='farmer-avatar'>";
                        }
                        else{
                        echo"<img src='rice.png' class='farmer-avatar'>";
                        }
                ?>                    
                </div>
<?php
} ?>
            </div>
            
    </div>


            
        </main>
    </div>
</div>    
</body>