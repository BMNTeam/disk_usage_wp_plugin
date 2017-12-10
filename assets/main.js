$ = jQuery.noConflict();

$( document ).ready(function() {
  // Get API URL directly from page
  var apiUrl = $('#apiUrl').val();
  var intervalCalls = {};


  var getFilesButton = $('#getFilesButton').click(function () {

    var $searchingResultsContent = $('#searchingResultsContent');
    var $progressBar = $('#progressBar');

    $progressBar.show();
    $('#temporaryContainer').hide();


    $searchingResultsContent.html('');

    // Make get request to the plugin API
    $.get(
      apiUrl, function (res, err) {
          if(err) {
            console.dir(err);
          }

          var resJ = JSON.parse(res);

          isNotSuccessfulRequest(resJ);

          var fileList = [];
          var $searchingResultsWrapper = $('#searchingResultsWrapper');

          $progressBar.hide();
          
          // Create HTML list with returned data
          fileList = buildFiles(resJ.files);

          $searchingResultsContent.append(fileList);
          $searchingResultsWrapper.show();

          addEventListenerToFolders();

        }
    )
  });

  function isNotSuccessfulRequest(resJ) {
    if(resJ.status === undefined || resJ.status !== 'OK') {
      intervalCalls = setInterval(repeateCallToFetchData, 1000, resJ);
    }
  }

  // TODO set own variable
  function repeateCallToFetchData(prevResponse) {
    var request = JSON.stringify(prevResponse);
    console.dir(request);

    $.post(
        apiUrl, { data: request },  function (res, err) {
          var resJ = JSON.parse(res);
          if (resJ.status !== undefined && resJ.status === 'OK') {
            //clearInterval(intervalCalls);
            return resJ;
          }

        }
    )
  }


});


// Add event listeners to lists that have unordered list inside
// prevented propagation
function addEventListenerToFolders() {
  $('li').click(function (event) {
    event.stopPropagation();
    $(this).find($('ul')).toggleClass('hidden');
  });

  $('ul >li').find($('ul')).toggleClass('hidden');
}


// Create list of folders and subfolders using recursion
function buildFiles(files) {
  console.dir(files);
  // Return undefined if there are no files to process;
  if(files === undefined) { return }


  // Create the container UL for the files in this level.
  var list = $('<ul>');
  for (var key in files) {
    console.dir(key);


    // Create an LI for each file and add it to the container
    var item = $('<li>');

    // Add the LI to the UL parent
    list.append(item);
    // Add  content to the item LI
    item.append($('<i class="dashicons dashicons-media-default"></i>'));
    item.append($('<span>' +files[key].file_name + '</span>'));
    item.append($('<span class="du_size">' +files[key].file_size + ' bytes</span>'));


    // if have nested object do the same
    if(files[key].length) {
      item.html('<i class="dashicons dashicons-category"></i></i>' + key);
      var childrenList = buildFiles(files[key]);
    }

    if (childrenList) {
      //Adding children (UL) container to the current item (LI)
      item.append(childrenList);
    }
  }
  // Return container with folders
  return list;
}
