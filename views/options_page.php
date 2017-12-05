<?php

function du_plugin_options_page() {


    ?>

    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-12"><h2>Options</h2></div>
            <div class="col-md-6">

                <div class="card text-left" id="temporaryContainer">
                    <div class="card-header">
                        Disk Utility customization
                    </div>
                    <div class="card-body">
                        <form action="#" method="post">
                            <label for="chunking-time">Chunking time period (sec)</label>
                            <div class="form-group">
                                <input type="text" name="chunking-time" class="form-control" placeholder="Example: 5">
                            </div>
                                <input type="submit" id="getFilesButton" class="btn btn-primary" value="Save">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php

}