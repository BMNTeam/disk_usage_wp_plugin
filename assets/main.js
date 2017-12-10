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
// TODO calculate folder size calculations
var folderSize = 0;
// Create list of folders and subfolders using recursion
function buildFiles(files) {

  console.dir(files);
  // Return undefined if there are no files to process;
  if(files === undefined) { return }


  // Create the container UL for the files in this level.
  var list = $('<ul>');
  for (var key in files) {

    // Create an LI for each file and add it to the container
    var item = $('<li>');
    // Add the LI to the UL parent
    list.append(item);
    item = buildTempleteForReturnedFiles(item, files[key]);

    if( files[key].file_size !== undefined ) {
      folderSize += files[key].file_size;
    }

    // Find folders using regexp ps folder returns
    // as "folder_" folder name format
    var pattern = /(folder_)+/gi;
    // if have nested object do the same
    if( pattern.test(key)) {
      // remove "folder_" before real folder name
      var folderName = key.match(/_+(.+)/)[1];
      item.html('<i class="dashicons dashicons-category"></i></i>' + folderName + folderSize);
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

function buildTempleteForReturnedFiles(item, key) {
  // Add  content to the item LI
  item.append($('<i class="dashicons dashicons-media-default"></i>'));
  item.append($('<span>' + key.file_name + '</span>'));
  item.append($('<span class="du_size">' + key.file_size + ' Kbytes</span>'));
  return item;
}
