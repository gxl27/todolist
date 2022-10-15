<?php
?>


<div class='d-flex align-items-center flex-column'>

  <form action="/" method="POST" id='form-item-new'> 
    <div class="mb-3 text-center">
      <h4> Add item </h4>
    </div>
    <div class="mb-3">
      <input type="text" id="title" name="title" placeholder=" Title ..."
          class="form-control<?php echo $item->hasError('title') ? ' is-invalid' : '' ?>">
      <div class="invalid-feedback">
          <?php echo $item->getFirstError('title') ?>
      </div>
      
    </div>
    <div class="mb-3">
      <input type="text" name="dater" placeholder="Set alarm ..." data-input
            class="form-control dateinput">
    </div>
    <div class="mb-2">
      <button type="submit" class="btn btn-success form-control py-2 ">Submit</button>
    </div>
  </form>
  <div class='d-flex mt-4' style='width:100%;font-weight:bolder;'>
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
        echo "<div class='item-list ". $items[$i]['active'] . "'>";
          echo "<div>". ($i + 1) ."</div>";
          echo "<div>". $items[$i]['title'] ."</div>";
          echo "<div>". $items[$i]['dater']->format('H:i | d-m-Y ') ."</div>";
          echo "<div>". $items[$i]['timeRemaining'] ."</div>";
          echo "<form action='/item' method='POST'>
            <input type='hidden' name='item' value='".$items[$i]['id']."'>
            <button class='btn btn-success btn-finish-task'>Completed</button></form>";
        echo "</div>";
      } 
    ?>
  </div>
</div>