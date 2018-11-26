<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Task <?php echo $data[0]; ?>
</button>

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
