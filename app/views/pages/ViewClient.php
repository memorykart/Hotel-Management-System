
<?php
class ViewClient extends View{
    public function output(){
        $clients=$this->model->readClients();
     
      
        $str = 
        <<<EOD
                    <div class="col-10 position">
                    <div id="client">
                    <div id="showClients">
                      <input type="text" id="bar" placeholder="Search by..." oninput="showClient()"><i class="fa fa-search"></i>
                      <select id="select" onchange="showClient()">
                        <option value="last_name">Last Name</option>
                        <option value="identification_no">ID Number</option>
                        <option value="company">Company</option>
                      </select>
                      <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
                        <thead>
                    <tr>
                <th style='text-align:center'><strong>First Name</strong></th>
                <th style='text-align:center'><strong>Last Name</strong></th>
                <th style='text-align:center'><strong>Nationality</strong></th>
                <th style='text-align:center'><strong>Identification No.</strong></th>
                <th style='text-align:center'><strong>Mobile</strong></th>
                <th style='text-align:center'><strong>E-mail</strong></th>
                <th style='text-align:center'><strong>Company</strong></th>
                EOD;
                if(!empty($_GET['flag'])&&$_GET['flag']==true){
                $str.=<<<EOD
                  <th style='text-align:center'><strong>Create Reservation</strong></th>             
                EOD;
                }
                else {
                $str.=<<<EOD
                  <th style='text-align:center'><strong>Edit</strong></th>
                  <th style='text-align:center'><strong>Delete</strong></th>                 
                EOD;

                }
                $str.=
                <<<EOD
                                                                                                                                                </tr>
                                                                                                                                                </thead>
                                                                                                                                                </div>

                
                 EOD;
   
    foreach ($clients as $client) {
        $str .= <<<EOD
                                          <tr>
                                        
                                            <td style='text-align:center'>$client->first_name</td>
                                            <td style='text-align:center'>$client->last_name</td>
                                            <td style='text-align:center'>$client->identification_no</td>
                                            <td style='text-align:center'>$client->nationality</td>
                                            <td style='text-align:center'>$client->mobile</td>
                                            <td style='text-align:center'>$client->email</td>
                                            <td style='text-align:center'>$client->company</td>
          EOD;
          if(!empty($_GET['flag'])&&$_GET['flag']==true){
            $str.=<<<EOD
          <td style='text-align:center'><a class="color"href="clients.php?action=resform&id=$client->id&quantity=1"><i class='fa fa-plus-square'></i></a></td>
          EOD;
          }
          else { $str.=<<<EOD
            <td style='text-align:center'><a class="color" href="clients.php?action=editform&id=$client->id"><i class='fa fa-edit'></i></a></td>
            <td style='text-align:center'><a class="color" href="clients.php?action=delete&id=$client->id"><i class='fa fa-trash'></i></a></td>
            EOD;


          }
    $str.=<<<EOD
        </tr>
        EOD;
      }
  $str .= <<<EOD
      </tbody>
    </table>
    <br>
  </div>
  </div>


  <a href="clients.php?action=addform"><button type="button" class="button" id="addBtn">Add Client</button></a>
  EOD;
  echo $str;
    
}
public function addForm(){

    $str=
    <<<EOD
            <div class="container"> 
            <div id="createClient">
            <h1>Add client</h1>
            <form>
            <input class="formE form-control border-3" type="text" name="first_name" placeholder="First Name...">
            <input class="formE form-control border-3" type="text" name="last_name" placeholder="Last Name...">
            <input class="formE form-control border-3" type="text" name="identification_no" placeholder="Identification Number...">
            <input class="formE form-control border-3" type="text" name="nationality" placeholder="Nationality...">
            <input class="formE form-control border-3" type="text" name="mobile" placeholder="Mobile...">
            <input class="formE form-control border-3" type="text" name="email" placeholder="E-mail...">
            <input class="formE form-control border-3" type="text" name="company" placeholder="Company...">
            <input type="submit" class="button2" name="action" value="Add" id="submitBtn"">
            </form>
            </div>
        </div>
        </div>

    EOD;
echo $str;

}
public function resForm($id,$quantity){

  $roomtypes=$this->model->getRoomTypes();
  $str=
  <<<EOD
                <div class="container">
              <div id="reservation">
              <h1>Create Reservation</h1>
              <form>
              <h4 class="words nu">Number<br>of Rooms</h4>
              <input type="number"size="1" class="formE form-control border-3"name="quantity" id="counter" value=1></input>
              <input type="text" name="id" value="$id" class="formE form-control border-3" id="id" hidden>
              <button type="submit" class="button3" name="action" value="resform">Add</button>
              </form>
              <form>
              <h4 class="words" for="room_type">Room Type</h4> 
              
   EOD;
   for($i=0;$i<$quantity;$i++){ 
     $str.=<<<EOD
     <select class="formE form-control border-3" name="room_type[]">
     EOD;
    foreach ($roomtypes as $room) {
  $str.=<<<EOD
     
                            <option value='$room'>$room</option>
          EOD;
                                  }
  $str.=
  <<<EOD
                           </select><br>
  EOD;

    

   }
          
         
              
        $str.=
        <<<EOD
        
        
      <h4 class="words arr">Arrival</h4><input type='date'class="formE form-control border-3" name='arrival'>
      <h4 class="words">Departure</h4> <input type='date' class="formE form-control border-3" name='departure'><br>
      <textarea class="formE form-control border-3" name="comments" rows="2" cols="50" placeholder="Comments..."></textarea> <br>
      <input type="text" name="client_ID" value="$id" class="formE form-control border-3" id="client_ID" hidden>
      <input type="text" name="quantity" value="$quantity" class="formE form-control border-3" id="quantity" hidden>
      <button type="submit" name="action" class="button2"value="createRes">Create Reservation</button>
      </form>
      </div>
      </div>
      </body>
      </html>
      EOD;
      echo $str;

}
public function editForm($id){
  $client = new Client($id);
$str=
    <<<EOD
            <div class="container">
            <h1>Edit Clients</h1>
            <form>
            <input class="formE form-control border-3" type="text" value="$client->first_name" name="first_name" placeholder="First Name...">
            <input class="formE form-control border-3" type="text" name="last_name" value="$client->last_name" placeholder="Last Name...">
            <input class="formE form-control border-3" type="text" name="identification_no" value="$client->identification_no"placeholder="Identification Number...">
            <input class="formE form-control border-3" type="text" name="nationality" value="$client->nationality"placeholder="Nationality...">
            <input class="formE form-control border-3" type="text" name="mobile" value="$client->mobile"placeholder="Mobile...">
            <input class="formE form-control border-3" type="text" name="email" value="$client->email"placeholder="E-mail...">
            <input class="formE form-control border-3" type="text" name="company"value="$client->company" placeholder="Company...">
            <input class="formE form-control border-3" type="text" name="id"value="$id" hidden placeholder="Company...">
            <button type="submit" class="button2" name="action" value="edit">Submit</button>
            </form>
        </div>
        
      

    EOD;
echo $str;

}
}