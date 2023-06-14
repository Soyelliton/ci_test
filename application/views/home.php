    <div class="container mt-4">
        <div class="clearfix mb-3">
            <h4 class="float-start">Your Table</h4>
            <a href="<?php echo base_url(); ?>add/profile">
                <button type="button" class="btn btn-primary float-end">Add Profile</button>
            </a>
        </div>
        <table class="table mt-3" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <?php 
                $i=0;
                foreach($get_all_profile as $single_profile){
                $i++;
            ?>
            <tbody>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><img src="<?php echo base_url('uploads/'.$single_profile->image);?>" alt="Photo" style="width:80px;height:120px"></td>
                    <td><?php echo $single_profile->fullname;?></td>
                    <td><?php echo $single_profile->phone;?></td>
                    <td><a type="button" class="btn btn-success me-2"
                            href="<?php echo base_url('edit/profile/' . $single_profile->id); ?>">Edit</a><a
                            type="button" class="btn btn-danger"
                            href="<?php echo base_url('delete/profile/' . $single_profile->id); ?>">Delete</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <script>
        let table = new DataTable('#myTable');
    </script>