<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Table</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container bg-white shadow rounded p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">
            Student List
        </h1>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
            Add Student
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                
                <div class="modal-body">
                    <form id="students" method="post" action="" enctype="multipart/form-data">
                       

                        <div class="mb-3">
                            <input type="hidden" name="id" id="hide_id">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Student Name">
                        </div>

                        <div class="mb-3">
                            <select class="form-select" id="gender" name="gender">
                                <option>Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                         <div class="mb-3">
                            <input type="text" id="dob" name="dob" class="form-control" placeholder="DOB">
                        </div>
                        <div class="mb-3">
                            
                            <input type="file" id="profile" name="profile" class="form-control">
                            <input type="text" name="hide_img" id="hide_img" class="form-control">
                            <img id="img" src="https://i.pinimg.com/736x/9b/d4/03/9bd403f16ddd7c2149efea4e4ec17656.jpg"
                        width="55" height="55" class="rounded-circle object-fit-cover">
                        </div>

                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button id="btnSave" name="btnSave" type="submit" class="btn btn-primary">
                                            Save
                                        </button>
                                        <button id="btnUpdate" name="btnUpdate" type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                    </form>
                </div>

               

            </div>
        </div>
    </div>

    <!-- DeleteModal -->
    <div class="modal fade" id="studentModal1" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Are you sure delete ID : </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                
                <div class="modal-body">
                    <form id="students" method="post" action="">

                    <div class="modal-footer">
                                        <input type="text" name="delete_id" id="delete_id">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button id="deleteData" name="deleteData" type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                       
                                    </div>
                    </form>
                </div>

               

            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center align-middle">

            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody id="tbody">
            <?php
                include './connection.php';
                global $con;
                $getstudent = "SELECT * FROM students";
                $result = $con->query($getstudent);

                if ($result->num_rows>0) {
                    while($row = $result->fetch_assoc()){
                        echo'
                            

                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['gender'].'</td>
                                <td>'.$row['dob'].'</td>
                                <td>
                                    <img src="./upload/'.$row['profile'].'"
                                    width="55" height="55" class="rounded-circle object-fit-cover">
                                </td>
                                <td>
                                    <button  type="submit"  class="btn btnEdit btn-warning btn-sm text-white">
                                        Edit
                                    </button>
                                
                                    <button type="button" data-id="'.$row['id'].'" id="btnDelete" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#studentModal1">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                

           
                        ';
                    }
                }

            ?>
             </tbody>


        

        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
<script>
    $(document).ready(function () {
        $('#profile').hide();
        $('#btnUpdate').hide();
        $('#img').click(function () {
        $('#profile').click();
    });

    $('#profile').change(function(){
        let formData = new FormData();
        let file = this.files[0];
        formData.append('profile',file);

    
        $.ajax(
            {
                url: 'movefile.php',
                method: 'POST',
                data : formData,
                contentType: false,
                processData:false,
                cache:false,
                success:function(res){
                    $('#img').attr('src','./upload/' + res);
                    $('#hide_img').val(res);
                }
            }
        )
    });

    $('#btnSave').click(function(){
    let name = $('#name').val().trim();
    let gender = $('#gender').val().trim();
    let dob = $('#dob').val().trim();
    let profile = $('#hide_img').val().trim();


    $.ajax({
        url:'addStudent.php',
        method:'POST',
        data:{
            name: name,
            gender:gender,
            dob: dob,
            profile:profile,
        },
        cache:false,
        success:function(res){
            $('tbody').append(`
            <tr>
                    <td>${res}</td>
                    <td>${name}</td>
                    <td>${gender}</td>
                    <td>${dob}</td>
                    <td>
                        <img src="./upload/${profile}"
                        width="55" height="55" class="rounded-circle object-fit-cover">
                    </td>
                    <td>
                        <button  class="btn btn-warning btn-sm text-white">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </td>
                </tr>
            `)
        }
    })
    });

    $(document).on('click','#btnDelete',function(){
    let id = $(this).attr('data-id');
    let row = $(this).closest('tr');
    $('#delete_id').val(id);
    $('#deleteData').click(function(){
        $.ajax({
            url: 'deleteStudent.php',
            method: 'POST',
            data: {
                delete_id:id
            },
            caches:false,
            success:function(res){
                row.remove();
            }
        })
    })
    });

    ////
     $(document).on('click', '.btnEdit', function () {

        $('#btnUpdate').show();
        $('#btnSave').hide();
        $('.modal-title').text('Edit Student');

        let row = $(this).closest('tr');

        let id = row.find('td').eq(0).text().trim();
        let name = row.find('td').eq(1).text().trim();
        let gender = row.find('td').eq(2).text().trim();
        let dob = row.find('td').eq(3).text().trim();
        let profile = row.find('img').attr('src');

        $('#hide_id').val(id);
        $('#name').val(name);
        $('#gender').val(gender);
        $('#dob').val(dob);
        $('#img').attr('src', profile);
        $('#hide_img').val(profile.split('/').pop());

      
    });$(document).on('click', '.btnEdit', function () {

    $('#btnUpdate').show();
    $('#btnSave').hide();
    $('.modal-title').text('Edit Student');

    let row = $(this).closest('tr');

    let id = row.find('td').eq(0).text().trim();
    let name = row.find('td').eq(1).text().trim();
    let gender = row.find('td').eq(2).text().trim();
    let dob = row.find('td').eq(3).text().trim();
    let profile = row.find('img').attr('src');

    $('#hide_id').val(id);
    $('#name').val(name);
    $('#gender').val(gender).change();
    $('#dob').val(dob);

    $('#img').attr('src', profile);
    $('#hide_img').val(profile.split('/').pop());

    // ✅ FIX MODAL OPEN
    let modalEl = document.getElementById('studentModal');
    let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
});

    $('#btnUpdate').click(function () {

        let id = $('#hide_id').val();
        let name = $('#name').val().trim();
        let gender = $('#gender').val().trim();
        let dob = $('#dob').val().trim();
        let profile = $('#hide_img').val().trim();

        $.ajax({
            url: 'editStudent.php',
            method: 'POST',
            data: { id, name, gender, dob, profile },
            success: function () {

                let row = $('tr').filter(function () {
                    return $(this).find('td').eq(0).text().trim() == id;
                });

                row.find('td').eq(1).text(name);
                row.find('td').eq(2).text(gender);
                row.find('td').eq(3).text(dob);
                row.find('td').eq(4).find('img').attr('src', './upload/' + profile);

                bootstrap.Modal.getInstance(document.getElementById('studentModal')).hide();

                // reset to Add Mode
    $('#btnSave').show();
    $('#btnUpdate').hide();
    $('#students')[0].reset();
        $('#img').attr('src','https://i.pinimg.com/736x/9b/d4/03/9bd403f16ddd7c2149efea4e4ec17656.jpg');

            }
        });
    });
    })



    
</script>
</html>