<?php include '../header.php'; ?>

<!-- content -->
<div class="area">
    <div class="container-fluid shadow-lg">
        <div class="top d-flex">
            <div class="">
                <button id="openNav" class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
            </div>
            <div class="logo text-primary">
               <h1>Learn</h1> 
            </div>
        </div>
    </div>

    <div class="container p-4">
        <form action="search.php" class="d-flex" method="get">
            <input type="email" name="user" class="form-control w-50 p-2 mr-sm-2" placeholder="Enter User Email">
            <button type="submit" class="btn btn-primary">search</button>
        </form>
    </div>

</div>
<?php include '../../includes/footer.php'; ?>

