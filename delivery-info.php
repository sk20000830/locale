<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delivery info</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<?php
    require "classes/user.php";
    require "classes/admin.php";

    session_start();

    $Cid = $_SESSION["user_id"];
    $status = $_SESSION["status"];

    $user = new User();
    $Udata = $user->get_1userdata($Cid);

    $admin = new Admin();
    $Ddata = $admin->display_delivery();

    date_default_timezone_set('Asia/Tokyo');
?>

<body>

    <div class="mb-5 pt-5" >
        <div class="container">
            <div class="mx-auto text-center">
                <a href="menu.php" class="btn btn-danger "><i class="fas fa-arrow-left"></i> Go Back to Menu</a>
            </div>
            <div class="text-center fs-5 mt-5">
                <span class="border border-2 border-dark rounded px-5 py-1 me-1">Shopping Cart</span>
                <i class="fas fa-caret-right"></i>
                <span class="border border-2 border-dark bg-dark text-light rounded  px-5 py-1 me-1">Input Adress</span>
                <i class="fas fa-caret-right"></i>
                <span class="border border-2 border-dark rounded px-5 py-1 me-1">Order Confirmation</span>
                <i class="fas fa-caret-right"></i>
                <span class="border border-2 border-dark rounded px-5 py-1">Order Completed</span>
            </div>
        </div>

        <div class="container" style="margin-top: 100px; width: 700px;">
            <h1 class="my-5 text-center"> Delivery settings</h1>
                <table class="table table-bordered table-secondary border-dark">
                    <tr>
                        <td class="w-25">Name</td>
                        <td class="bg-white"><?=$Udata['first_name']?> <?=$Udata['last_name']?></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td class="bg-white"><?=$Udata['email']?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td class="bg-white"><?=$Udata['contact_number']?></td>
                    </tr>
                    <tr>
                        <td>Delivery Adress</td>
                        <td class="bg-white"><?=$Udata['adress']?></td>
                    </tr>
                </table><br>

            <form action="order-confirm.php" method="post">
                <p><i class="fas fa-square"></i> Delivery time</p>
                <?php if($_GET["message"] == "unavailable"){?>
                    <span class="text-danger"> Please select available time</span>
                <?php }?>
                <table class="table table-bordered table-secondary border-dark">
                    <tr>
                        <td class="w-25"><input type="radio" name="Dtime" value="instant" checked> Instant Delivery</td>
                        <td  class="bg-white">waiting time: <?=$Ddata["delivery_time"]?>min</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="Dtime" value="pre"> Pre Order</td>
                        <td  class="bg-white">
                            <p>Please select among the time after 1hour from current time (<?=date("H:i")?>)<br> Available time (<?=$Ddata["open_time"]?> ~ <?=$Ddata["close_time"]?>)</p>
                            <p>today <input type="time" name="pretime"></p> 
                        </td>
                    </tr>
                </table>
                <p class="mt-5"><i class="fas fa-square"></i> Notes???Requests</p>
                <textarea name="note" cols="82" rows="4"></textarea>
                <div class="row col-8 mx-auto mt-5">
                    <div class="col text-end">
                        <a href="adress.php" class="btn btn-secondary w-50">Back</a>
                    </div>
                    <div class="col text-start">
                        <input type="hidden" name="Wtime" value="<?=$Ddata['delivery_time']?>">
                        <input type="hidden" name="open" value="<?=$Ddata["open_time"]?>">
                        <input type="hidden" name="close" value="<?=$Ddata["close_time"]?>">
                        <button class="btn btn-warning hvr-underline-from-center w-50">Next</button>
                    </div>
                </div>                             
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>