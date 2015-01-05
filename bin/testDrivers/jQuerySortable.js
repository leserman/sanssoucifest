// jQuerySortable.js
// sortable list maintenance functions ala David 7/20/14

    function formattedRunTimeString(seconds) {
      var minutes = Math.floor(seconds / 60);
      var secondsModMinutes = seconds % 60;
      var secondsModMinutesString;
      if (secondsModMinutes == 0) { 
        secondsModMinutesString = '00';
      } else if (secondsModMinutes <= 9) { 
        secondsModMinutesString = '0' + secondsModMinutes.toString(); 
      } else { 
        secondsModMinutesString = secondsModMinutes.toString(); 
      }
      var timeString = minutes + ":" + secondsModMinutesString;
      return timeString;
    }

    function initSortableAttributesDisplay() {
      $( '.sortable' ).each(function( index, elem ) {
        displaySortableAttributes($(this)); 
      });
    }

    function displaySortableAttributes(sortable) {
      var runTimeSeconds = 0;
      var workIdList = '';
      var sortableListId = $( sortable ).attr('id');
      var sortableListIndex = sortableListId.split('-')[1];
      var sortableWorkId = "";
      var sortableWorkIdParts;
      $( sortable ).find( 'li' ).each(function (sortable) {
        //for each list item in the sortable, add up the runtime seconds.
        runTimeSeconds += Number($( this ).attr('runTimeSeconds'));
        sortableWorkIdParts = $( this ).attr('id').split('-');
        sortableWorkId = sortableWorkIdParts[sortableWorkIdParts.length-1];
        workIdList += sortableWorkId + " ";
      });
      var totalRuntimeString = formattedRunTimeString(runTimeSeconds);
      // find the sortable's sibling eq(0) with class = runTimeDisplayText and
      // inside of that, find the span named '#trt-' + sortableListIndex
      var runtimeTextLocation = $( sortable ).siblings().find('#trt-' + sortableListIndex);
      $( runtimeTextLocation ).text(totalRuntimeString);
      var workIdTextLocation = $( sortable ).siblings().find('#wrks-' + sortableListIndex);
      $( workIdTextLocation ).text(workIdList);
      if (sortableListIndex != '0') {
        var workIdsDataLocation = $( sortable ).siblings().find('#wrkIds-' + sortableListIndex);
        $( workIdsDataLocation ).val(workIdList);
      }
      return totalRuntimeString;
    }
    
    function userChanged(e, ui) {
      var lists = $( 'ul' );
      var sortableLists = lists.filter( '.sortable' );
      var theTarget = e.target;
      var targetClasses = theTarget.className;
      if (window.console) console.log($( theTarget ).attr('id') + " with classes: " + targetClasses);
      $( sortableLists ).each(function() {
        // TODO: displaySortableAttributes gets called too often. It should only be called for a sortable that changed.
        // But I don't know how to detect only those sortables that have changed with "connected list"s. So, I
        // only get too many or (if I filter on "computable", as below in comments, too few. The binding of
        // "sortUpdate" is somehow inadequate for the connected lists. 
        displaySortableAttributes($( this ));
      });
//      $( theTarget, function() {                    // THESE LINES ARE REFERENCED IN THE COMMENT ABOVE.
//        displaySortableAttributes( $( theTarget ));
//      });
    }
