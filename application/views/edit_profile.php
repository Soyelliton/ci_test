<div class="container mt-4">
    <h3 style="text-align:center" class="mb-5">Edit Person Details</h3>
    <form action="<?php echo base_url('update/profile/'.$profile_info_by_id->id);?>" method="post" enctype="multipart/form-data">
        <table class="col-md-12">
            <tbody>
                <tr>
                    <td class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Image</label>
                            <input type='file' name="userfile" onChange="readURL(this);" style="color:red">
                            <input type='hidden' name="profile_delete_image" value="<?php echo base_url('uploads/'.$profile_info_by_id->image);?>">
                            <img id="blah" src="<?php echo base_url('uploads/'.$profile_info_by_id->image);?>" alt="your image"
                                height="150" width="150" style="border:1px dotted red" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                            value="<?php echo $profile_info_by_id->fullname;?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleFormControlInput1"
                            value="<?php echo $profile_info_by_id->username;?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1"
                            placeholder="password">
                        </div>
                    </td>
                    <td class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                            value="<?php echo $profile_info_by_id->email;?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" id="exampleFormControlInput1"
                            value="<?php echo $profile_info_by_id->phone;?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1"
                                rows="1"><?php echo $profile_info_by_id->address;?></textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary form-control">Save</button>
    </form>
</div>

<script>
    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

document.getElementById('gender').value = <?php echo $profile_info_by_id->gender;?>;
</script>