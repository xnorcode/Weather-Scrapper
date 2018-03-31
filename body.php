<div class="container">

  <h1 class="display-4">What's The Weather?</h1>

  <form>

    <div class="row justify-content-center">
      <label for="city">Enter the name of a city.</label>
      <input id="city" type="text" name="city" class="form-control" placeholder="Eg. Paris, London" value="<?php echo $city; ?>">
    </div>

    <div class="row justify-content-center">
      <button id="submit" type="submit" class="btn btn-primary">Go!</button>
    </div>

    <?php echo $output.$error; ?>

  </form>

</div>
