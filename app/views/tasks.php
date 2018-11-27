<?php $user = $_SESSION['authUser'] || json_decode($_COOKIE['beejeeTaskUser']); ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Task
</button>
<?php if (!$user) { ?>
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#adminLogin">
    Login For Admin
  </button>
<?php } ?>
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

<div class="modal fade" id="adminLogin" tabindex="-1" role="dialog" aria-labelledby="adminLoginTitle"
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

        <form action="/auth/login" method="post" id="loginUser">
          <div class="form-group">
            <label>Login</label>
            <input type="text" class="form-control" name="login">
            <label>Password</label>
            <input type="text" class="form-control" name="password">
          </div>
        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="loginUser" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>

<div class="accordion" id="accordionExample">
    <?php foreach ($data['data'] as $key => $task) { ?>
      <div class="card">
        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree<?php echo $key ?>"
             aria-expanded="true" aria-controls="collapseThree">
          <div class="d-inline p-3 m-lg-5">First name: <?php echo $task['first_name'] ?></div>
          <div class="d-inline p-3 m-lg-5">Last name: <?php echo $task['last_name'] ?></div>
          <div class="d-inline p-3 m-lg-5">Email: <?php echo $task['email'] ?></div>
          <div class="d-inline p-3 m-lg-5">Image:
            <img src="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . $task['image'] ?>"
                 height="320px" width="240px" alt="Image lost" />
          </div>
          <div class="d-inline p-3 m-lg-1">Delete</div>
        </div>
        <div id="collapseThree<?php echo $key ?>" class="collapse show"
             aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <h2>Description: </h2>
              <?php echo $task['description'] ?>
          </div>
        </div>
      </div>
    <?php } ?>
</div>

<?php if (isset($data['pages'])) {
    $page = 1; ?>
  <nav aria-label="...">
    <ul class="pagination pagination-lg float-right">
        <?php while ($data['pages']) {
            if ((int)filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS) === $page) {
                echo "<li class='page-item disabled'>
                        <a class='page-link' href='/task/index?page=$page' tabindex='-1'>$page</a>
                      </li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='/task/index?page=$page'>$page</a></li>";
            }
            $page++;
            $data['pages']--;
        } ?>
    </ul>
  </nav>
<?php } ?>
