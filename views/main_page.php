<?php

function du_plugin_main_page() {

    require_once(DU__PLUGIN_DIR.'/actions/scan_dir_class.php');
   ?>

    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-12"><h2>Welcome to Disk Utility Plugin</h2></div>
            <div class="col-md-12">
                <div class="hidden" id="progressBar">
                    <div class=" progress ">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
                <div class="card text-left" id="temporaryContainer">
                    <div class="card-header">
                        Free Up Space
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Some instructions to start using the plugin </h4>
                        <p class="card-left">Follow this steps to start using the plugin</p>
                        <ol>
                            <li>Lorem ipsum.</li>
                            <li>Lorem ipsum dolor.</li>
                            <li>Lorem ipsum dolor sit amet.</li>
                            <li>Lorem.</li>
                        </ol>
                    </div>
                    <div class="card-footer text-muted">
                        Last scan: never
                    </div>
                </div>

                <div class="hidden search_results__block" id="searchingResultsWrapper">
                    <div class=" card text-left" >
                        <div class="card-header">
                            Free Up Space
                        </div>
                        <br>
                        <div id="searchingResultsContent">

                        </div>
                        <div class="card-body" id="searchingResultsContent">
                            <div class="gu_folder">
                                <span class="folder"></span>
                            </div>

                        </div>
                        <div class="card-footer text-muted">
                            Last scan: never
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-left">
                    <div class="card-header">
                        Control section
                    </div>
                    <div class="card-body">
                        <p class="card-left">Click scan to start cleaning files</p>
                        <button type="button" id="getFilesButton" class="btn btn-primary"> Get structure </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input id="apiUrl" type="hidden" value="<?php echo(DU__API_URL)?>">
<?php

}