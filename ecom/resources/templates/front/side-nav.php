    <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">

                <?php


                    $theQuery = query("SELECT * FROM categories");

                    confirm($theQuery);

                    while($row = mysqli_fetch_array($theQuery)){

                    echo "<a href='' class='list-group-item'> {$row['cat_title']} </a>";

                    }
                ?>

                    <a href="category.html" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>