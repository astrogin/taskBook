<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Task
</button>
<?php print_r($data); ?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form action="/task/create" enctype="multipart/form-data" method="post" id="newTask">
          <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" name="first_name">
            <label>Last name</label>
            <input type="text" class="form-control" name="last_name">
            <label>Email address</label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label>Example textarea</label>
            <textarea class="form-control" rows="3" name="description"></textarea>
          </div>
          <div class="form-group">
            <label>Example file input</label>
            <input type="file" class="form-control-file" name="image">
          </div>
        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="newTask" class="btn btn-primary">Save Task</button>
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="accordionExample">
  <?php foreach ($data['data'] as $task) ?>
  <div class="card">
    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <div class="d-inline bg-primary p-3 align-middle">First name: <?php echo $task['first_name'] ?></div>
      <div class="d-inline bg-primary p-3">Last name: <?php echo $task['last_name'] ?></div>
      <div class="d-inline bg-primary p-3">Email: <?php echo $task['email'] ?></div>
      <div class="d-inline bg-primary p-3">Image:
        <img src="/../<?php echo $task['image'] ?>" height="320px" width="240px" alt="Image lost" />
        <?php echo "<img src='" . $task['image'] . "' height='320px' width='240px' alt='Image lost' />" ?>
      </div>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
