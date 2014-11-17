<?php  
include 'core/init.php';
include 'includes/overall/header.php';
include 'includes/aside.php';
?>

<?php
    ob_start();
    if (isset($_GET['success']) == 1)
    {
        echo 'You\'ve submitted it successfully!<br>';
        echo "<a href= prod_details.php?prod_id=$_GET[prod_id]>Click here </a> to go back to the product";
    }
    else {
        $prod_id = $_GET['prod_id'];
        $query = mysql_query("SELECT * FROM products WHERE `prod_id` = $prod_id");
        $prod_count = mysql_num_rows($query);
        // echo $prod_count;
        if ($prod_count > 0)
        {
            while ( $row = mysql_fetch_array($query)) { ?>
                <div class="post_content">
                    
                    <?php 
                        date_default_timezone_set( 'America/New_York' );
                        $date = $row['expiry'];
                        $date = strtotime($date);
                        $rem = $date - time();
                        $day = floor($rem / 86400);
                        $hr  = floor(($rem % 86400) / 3600);
                        $min = floor(($rem % 3600) / 60);
                        $sec = ($rem % 60);
                        if ($day < 0)
                            echo "<b>Item has Expired Already</b>";
                    ?>
                    <h1><?php echo $row['title'];?></h1>
                    
                    <?php echo "<img src=$row[image]" ?> <br>

                    <p><b><br>Product Description</b><br>
                    <?php echo $row['description'];?></p>

                    <p><b>Author:       </b><?php echo $row['author'];?></p>
                    <p><b>Year:         </b><?php echo $row['year'];?></p>
                    <p><b>Publisher:    </b><?php echo $row['publisher'];?></p>
                    <p><b>Language:     </b><?php echo $row['language'];?></p>
                    <p><b>Current Bid:  </b>$<?php echo $row['current_bid']; ?>
                    <?php
                        if(logged_in() == true) 
                        {
                            if ($day > 0) 
                            {
                                if(empty($_POST) === false)
                                {
                                    if ($_POST['bid'] > $row['current_bid']) {
                                        register_bid($session_user_id, $row['prod_id'], $_POST['bid']);
                                        header("Location: prod_details.php?prod_id=". $row["prod_id"] ."&success=1");
                                        exit();
                                    }
                                    else
                                        echo "You must enter a bid greater than the current bid.";
                                }
                            ?>
                                <form action="" method="post">
                                    <b>Make a bid:</b> <br>
                                    <input type="text" name="bid" placeholder="Enter a bid" required>
                                    <input type="submit" name='bid_button' value="submit bid">
                                </form>

                <?php       } 
                        }
                ?>
                    </p>

                    <p><b>Bid Expires in:</b>
                        <?php
                            if ($day < 0)
                                echo "Item has Expired Already";
                            else 
                            {    
                                if($day) echo "$day Days ";
                                if($hr) echo "$hr Hours ";
                                if($min) echo "$min Minutes";
                            }
                        ?>
                    </p>
                    <p><b>Highest Bidder:</b>  
                        <?php 
                            echo username_from_user_id($row['cur_highest_bidder']);
                        ?>
                        </p><br>
                    
                    <h4>Comments</h4>
                    
                    <div class="comment-block">
                        <?php
                        $result = mysql_query("SELECT * FROM `comment` WHERE `prod_id` = ". $row['prod_id']."");

                        while ( $row1 = mysql_fetch_array($result)) { ?>
                            
                            <div class="comment-item">
                                <div class="comment-post">
                                    <h3><?php echo $row1['name']; ?> <span>said....</span></h3>
                                    <p><?php echo $row1['comment']; ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                    
                    <h4>Submit a comment</h4>
                    
                    <?php
                        if(empty($_POST) === false) 
                        {
                            $register_comment = array(
                                'name'      => $_POST['name'],
                                'mail'      => $_POST['mail'],
                                'comment'   => $_POST['comment'],
                                'prod_id'   => $row['prod_id']
                            );
                            
                            register_comment($register_comment);
                            header("Location: prod_details.php?prod_id=". $row["prod_id"] ."&success=1");
                            exit();
                        }
                    ?>

                    <form action="" method="post">
                        <ul>
                            <li>
                                Name* <br>
                                <input type="text" name="name" placeholder="Your name here...." required>
                            </li>
                            <li>
                                E-mail* <br>
                                <input type="email" name="mail" placeholder="Your mail here...." required>
                            </li>
                            <li>
                                Your comment *<br>
                                <textarea name="comment" cols="30" rows="10" placeholder="Type your comment here...." required></textarea>
                            </li>
                            <li>
                                <input type="submit" name='comment_button' value="Submit Comment">
                            </li>
                        </ul>
                    </form>

                </div>
            <?php
            }
        }
    }
?>

<?php include 'includes/overall/footer.php'; ?>