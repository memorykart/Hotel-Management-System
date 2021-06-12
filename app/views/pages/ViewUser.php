<?php
class ViewUser extends View{
  public function output(){
    $users = $this->model->readUsers();
    $str = 
    <<<EOD
    <h2>Employees</h2>
    <div id="viewEmployees">
      <table>
        <thead>
          <tr>
            <th><strong>ID</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Username</strong></th>
            <th><strong>Position</strong></th>
            <th><strong>Edit</strong></th>
            <th><strong>Delete</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
        foreach ($users as $user) {
          $str .= <<<EOD
          <tr>
            <td>$user->id</td>
            <td>$user->first_name</td>
            <td>$user->last_name</td>
            <td>$user->username</td>
            <td>$user->position</td>
            <td><a href="employees.php?action=editform&id=$user->id">Edit</a></td>
            <td><a href="employees.php?action=delete&id=$user->id">Delete</a></td>
          </tr>
          EOD;
        }
    $str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <a href="employees.php?action=addform"><button type="button" class="button" id="addBtn">Add Employee</button></a>
    EOD;
    echo $str;
  }
  public function addForm(){
    $str=<<<EOD
    <div id="addEmployees">
    <form class="addE">
        <input type="text" name="first_name" id="Fname" class="form form-control mb-4 border-0 py-4" placeholder="First Name"><br>
        <input type="text" name="last_name" id="Lname" class="form form-control mb-4 border-0 py-4" placeholder="Last Name"><br>
        <input type="password" name="password" id="password" class="form form-control mb-4 border-0 py-4"placeholder="Password"><br>
        <input type="text" name="username" id="username" class="form form-control mb-4 border-0 py-4" placeholder="UserName"><br>
        <select id="position" name="position" class="form form-control mb-2 border-0">

          <option hidden disabled selected value>Position</option>
          <option value='front_clerk'>Front Clerk</option>
          <option value='reservation_clerk'>Reservation Clerk</option>
          <option value='HK_employee'>Housekeeping</option>
        </select><br>
        <input type="submit" class="submitEmployee button" name="action" value="add" id="submitBtn" onclick="addEmployee()">
      </form>
    </div>
    EOD;
    echo $str;
  }
  public function editForm($id){
    $user = new User($id);
      $str=<<<EOD
      <form class='editE'>
        <input type="text" name="id" value="$id" style="display:none">
        <label class='names' for='first_name'>First Name</label><input type='text' name='first_name' id='Fname' class='formE form-control border-0 ' value='$user->first_name' '> <br><br>
        <label class='names' for='last_name'>Last Name</label><input type='text' name='last_name' id='Lname' class='formE form-control border-0 ' value='$user->last_name' '> <br><br>
        <label class='names' for='username'>username</label><input type='text' name='username' id='username' class='formE form-control border-0 ' value='$user->username' '> <br><br>
        <label class='names' for='password'>password</label><input type='password' name='password' id='password' class='formE form-control  border-0' value='' '> <br><br>
        <label class='names' for='position'>position</label>
        <select id='position' name='position' class='formE form-control mb-2 border-0'>
        <option value='front_clerk'>Front Clerk</option>
        <option value='reservation_clerk'>Reservation Clerk</option>
        <option value='HK_employee'>HouseKeeping Clerk</option>
        </select> <br><br>
        <input type='submit'  name='action' value="edit" class='button'>
      </form>
      EOD;
      echo $str;
  }
  
}
?>