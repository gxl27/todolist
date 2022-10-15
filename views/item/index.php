<?php
?>


<div class='d-flex align-items-center flex-column'>
<div class='d-flex mb-2' style='width:100%;font-weight:bolder;'>
Number of items: <?php echo sizeof($items) ?>
</div>
  <div id='container-item-list' class="mt-2">
    <div class='item-list' style='font-weight:bolder'>
      <div>#</div>
      <div>Item</div>
      <div>Date</div>
      <div>Remaining</div>
      <div>Details</div>
    </div>
    <?php 
      for($i = 0; $i< sizeof($items); $i++) {
        echo "<div class='item-list ". $items[$i]['active']. " ". $items[$i]['isFinished'] . "'>";
          echo "<div>". ($i + 1) ."</div>";
          echo "<div>". $items[$i]['title'] ."</div>";
          echo "<div>". $items[$i]['dater']->format('H:i | d-m-Y ') ."</div>";
          echo "<div>". $items[$i]['timeRemaining'] ."</div>";
          if(!$items[$i]['isFinished']) {
            echo "<form action='/item' method='POST'>
              <input type='hidden' name='item' value='".$items[$i]['id']."'>
              <button class='btn btn-success btn-finish-task'>Completed</button></form>";
          }else {
            echo  "<div class='btn btn-disabled'>Finished</div>";
          }
        echo "</div>";
      } 
    ?>
  </div>
</div>